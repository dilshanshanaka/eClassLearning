from fastapi import FastAPI, Request
from fastapi.middleware.cors import CORSMiddleware
import mysql.connector
import uvicorn
import pandas as pd 
import numpy as np 
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import linear_kernel
from pydantic import BaseModel

# Database Connection
mydb = mysql.connector.connect(
  host="localhost",
  user="user",
  password="pass@22",
  database="eClassLearning"
)
 
# Creating FastAPI instance
app = FastAPI()


#CORS
origins = ["*"]

app.add_middleware(
    CORSMiddleware,
    allow_origins=origins,
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)


# Loading Dataset
mycursor = mydb.cursor()
mycursor.execute("SELECT * FROM courses")
myresult = mycursor.fetchall()

# Data
df = pd.DataFrame(myresult)

# Text to vector
tfidf = TfidfVectorizer(stop_words='english')

tfidf_matrix = tfidf.fit_transform(df[2])


cosine_sim = linear_kernel(tfidf_matrix, tfidf_matrix)
indices = pd.Series(df.index, index=df[1]).drop_duplicates()

# Recommendation Model
def get_recommendations(CourseName, cosine_sim=cosine_sim):

    idx = indices[CourseName]

    sim_scores = list(enumerate(cosine_sim[idx]))

    sim_scores = sorted(sim_scores, key=lambda x: x[1], reverse=True)

    sim_scores = sim_scores[1:5]

    course_indices = [i[0] for i in sim_scores]

    return df[1].iloc[course_indices]


@app.get("/predict/{course_name}")
def read_root(course_name: str, request: Request):
    client_host = request.client.host
    return {"data": get_recommendations(course_name)}
