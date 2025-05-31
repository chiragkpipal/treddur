var multiSelectBasic = document.getElementById("multiselect-basic"),
	multiSelectOptGroup = document.getElementById("multiselect-optiongroup");

if (multiSelectBasic) {
    multi(multiSelectBasic, { enable_search: !1 });
}

if (multiSelectOptGroup) {
    multi(multiSelectOptGroup, { non_selected_header: "Area", selected_header: "Selected" });
}

// Select all elements whose IDs start with 'multiselect-header'
var multiSelectHeaders = document.querySelectorAll("[id^='multiselect-header']");

multiSelectHeaders.forEach(function(multiSelectHeader) {
    multi(multiSelectHeader, { non_selected_header: "Area", selected_header: "Selected" });
});
