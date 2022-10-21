@extends('layouts.default')

@section('content')

<div class="content w-1/2 shadow-2xl rounded-xl bg-white mx-auto my-20">
    <div class="flex sapce-x-12 py-6 profile">
        <div class="image w-1/3 mx-10">
            @php
            $imagePath = "images/blank-profile-picture.png";

            if ($instructor->profile_image_path != NULL){
            $imagePath = $instructor->profile_image_path;
            }
            @endphp

            <img id="profileImage" class="w-[150px] h-[150px] rounded-full mx-auto my-3" src="{{ asset($imagePath) }}" alt="profile image">

        </div>
        <div>
            <h4 class="text-sm text-purple-800 font-bold mb-2 mt-4">[INSTRUCTOR]</h4>
            <h4 class="text-2xl text-gray-800 font-bold">{{ $instructor->first_name .' '. $instructor->last_name }}</h4>

            <h4 class="text-md text-gray-800 font-semibold">{{ $instructor->city }}</h4>
            <h4 class="text-md text-gray-700 mt-3 pr-5 mb-5">{{ $instructor->bio }}</h4>
            @if($instructorAppointment->status == true)
            <h4 class="text-md text-gray-700 mt-3 pr-5 mb-3 font-semibold">Availability: <span class="text-green-600">available</span></h4>
            @else
            <h4 class="text-md text-gray-700 mt-3 pr-5 mb-1 font-semibold">Availability: unavailable</h4>
            @endif


            @if($userRole == "student")
            @if($instructorAppointment->status == true)
            <h4 class="text-md text-gray-800 font-semibold">Charge Per Hour : LKR{{ $instructorAppointment->charge_per_hour }}</h4>
            @else
            <h4 class="text-md text-gray-800 font-semibold mt-3 pr-5 mb-5">Instructor unavailble for appointments.</h4>
            @endif
            @else
            <h4 class="text-md text-gray-800 font-semibold mt-3 pr-5 mb-5">Login as a student to book an appointment.</h4>
            @endif
        </div>
    </div>

    @if($instructorAppointment->status == true)
    <hr class="my-1">
    <div class="flex space-x-8 mx-10">
        <div class="date"> Date:
            <input id="appointmentDate" type="date" class="mt-1 text-slate-600 border border-gray-300 drop-shadow rounded-md w-full h-8 px-3">
        </div>
        <div class="time">
            Session:
            @foreach($slots as $slot)
            <div class="flex items-center mb-4">
                <input id="sessionSlot" type="radio" value="{{ $slot['value'] }}" name="sessionSlot" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                <label for="default-radio-1" class="ml-2 text-sm font-medium text-gray-900">{{ $slot['start_time']. ' to '.$slot['end_time'] }}</label>
            </div>
            @endforeach
        </div>
    </div>
    <button type="button" id="addAppointment" class="mx-10 my-4 text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center mt-3">Add New Appointment</button>
    @endif
</div>


<input type="text" hidden value="{{ $instructor->id }}" id="instructorId">
<input type="text" hidden value="{{ $instructorAppointment->charge_per_hour }}" id="chargePerHour">

<script>
    _token = $('meta[name="csrf-token"]').attr('content'); // CSRF Token

    var instructorId = $("#instructorId").val();
    var appointmentDate = $("#appointmentDate").val();
    var startTime;
    var endTime;

    $("#addAppointment").click(function(e) {
        e.preventDefault();
        var slotValue = document.querySelector('input[name="sessionSlot"]:checked').value;

        $.ajax({
            method: 'GET',
            url: "{{ route('appointment.availability', $instructor->id) }}",
            headers: {
                'X-CSRF-TOKEN': _token
            }
        }).done(function(data) {
            var value = data.data;
            $.each(value, function(key, value) {
                if (value.value == slotValue) {
                    // Time Slot
                    startTime = value.start_time;
                    endTime = value.end_time;


                    // Form Data
                    var formData = {
                        appointmentDate: $("#appointmentDate").val(),
                        chargePerHour: $("#chargePerHour").val(),
                        startTime: startTime,
                        endTime: endTime,
                        instructorId: instructorId
                    };


                    $("span").remove(".validation-error"); // Remove Error Messages

                    $.ajax({
                        method: 'POST',
                        url: "{{ route('student.addnewappointment') }}",
                        headers: {
                            'X-CSRF-TOKEN': _token
                        },
                        data: formData,
                    }).done(function(data) {

                        console.log(data);

                        $("span").remove(".validation-error"); // Remove Error Messages
                        // Check For Errors
                        if (data.error != undefined) {
                            // Error Message
                            $.each(data.error, function(key, value) {
                                $(`#` + key).after(`<span class="validation-error mt-2 text-sm text-red-600 dark:text-red-500">` + value + `</span>`);
                            });
                        } else {
                            window.location.replace("{{ route('student.courses') }}");
                        }
                    });

                }
            });
        });
    });
</script>

@endsection