<!-- Dropdown Button Starts -->
<button id="dropdownDefault" data-dropdown-toggle="dropdown" class="drop-down-button text-grey-600 hover:text-blue-900 inline-flex items-center" type="button">
    Course Categories
    <svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
    </svg>
</button>
<!-- Dropdown Button Ends -->

<!-- Dropdown List Starts -->
<div id="dropdownList" class="dropdown-list hidden absolute z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
    <ul class="py-1 text-sm text-gray-700" aria-labelledby="categoriesDropdown">
        @foreach ($mainCategories as $mainCategory)
        <li>
            <a href="{{ route('courses.maincategory', $mainCategory->id) }}" class="block py-2 px-1 hover:bg-gray-100">{{ $mainCategory->title }}</a>
        </li>
        @endforeach
    </ul>
</div>
<!-- Dropdown List Ends -->
