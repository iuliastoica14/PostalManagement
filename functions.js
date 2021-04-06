async function getStreetsByCity(formData) {
    var response = await fetch('api/streets/get.php', {
        method: 'POST',
        body: formData
    });

    if (response.ok) {
        // clean current <select> element ... remove its <option> elements
        var streetsSelectElem = document.getElementById('street_postcode');
        streetsSelectElem.innerHTML = '';

        var json = await response.json();
        console.log(json);
        // if we have no errors
        if(!json.error) {
            // loop through the response objects (streets)
            document.getElementById('street_postcode').disabled=false;
            document.getElementById('postcode_add').disabled = false;
            for(var i = 0; i < json.length; i++) {
                // add new <option> HTML elements with the street id and name
                streetsSelectElem.options.add( new Option(json[i].name, json[i].id) );
            }
        }
        else{
            document.getElementById('street_postcode').disabled=true;
            document.getElementById('postcode_add').disabled = true;
            alert("Adaugati o strada acestui oras!");
            return;
        }

    }
    else {
        alert("HTTP-Error: " + response.status);
    }
}


async function create(resouce,formData){
    var response= await fetch('api/'+resouce+'/create.php',{
        method: 'POST',
        body: formData
    });
    if(response.ok){
        var json=await response.json();
        alert(json.message);
    } else{
        alert("Error: "+response.status);
    }
}


window.addEventListener("DOMContentLoaded", function(){
    var citySubmit=document.getElementById('city_form');
    var streetSubmit=document.getElementById('street_form');
    var postcodeSubmit=document.getElementById('postcode_form');

    citySubmit.addEventListener("submit", function(event){
        event.preventDefault();
        var formData= new FormData(this);
        create('cities',formData);
        //window.location.replace("https://localhost/Programs/myPostalApp");
    });

    streetSubmit.addEventListener("submit", function(event){
        event.preventDefault();
        var formData=new FormData(this);
        create('streets',formData);
        //window.location.replace("https://localhost/Programs/myPostalApp");
    })

    postcodeSubmit.addEventListener("submit", function(event){
        event.preventDefault();
        var formData=new FormData(this);
        create('postcodes',formData);
        //window.location.replace("https://localhost/Programs/myPostalApp");
    })

    var citySelector = document.getElementById('city_postcode');
	
	// country selector change event (when an option is selected from the select dropdown)
	citySelector.addEventListener('change', function(evt) {
		// create a new empty FormData object ... unlike the above FormData objects where we pass the entire form being submitted, here we just need to pass the selected option value (this.value) as city_id to our App.getStreetsByCity function
		var formData = new FormData();
		formData.append('city_id', this.value);
        getStreetsByCity(formData);
	});
});