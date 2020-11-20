if (window.google !== undefined) {
    if (document.getElementById('address1')) {
        let inputs = {
            address: document.getElementById('address1'),
            postalCode: document.getElementById('zipcode'),
            city: document.getElementById('city'),
            country: document.getElementById('country')
        };
        let countries = [];
        for (i in inputs.country.options) {
            if (inputs.country.options[i].value) {
                countries.push({value: inputs.country.options[i].value, label: inputs.country.options[i].innerText.toLowerCase()});
            }
        }
        let autocomplete = new google.maps.places.Autocomplete(
            document.getElementById("address1"),
            { types: ["address"] }
        );

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                let geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };
                let circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy,
                });
                autocomplete.setBounds(circle.getBounds());
            });
        }
        autocomplete.setFields(["address_component"]);
        autocomplete.addListener("place_changed", () => {
            let place = autocomplete.getPlace();
            if (place.address_components) {
                Object.values(inputs).forEach(i => i.value = '');
                let tmp = {};
                for (let component of place.address_components) {
                    let addressType = component.types[0];
                    tmp[addressType] = component['long_name'] ? component['long_name'] : '';
                }
                let autoCompleteCountry = countries.find(c => c.label.indexOf(tmp.country.toLowerCase()) === 0);
                inputs.address.value = (tmp.street_number ? tmp.street_number : '') + (tmp.route ? (tmp.street_number ? ' ' : '') + tmp.route : '');
                inputs.city.value = tmp.locality ? tmp.locality : (tmp.postal_town ? tmp.postal_town : (tmp.administrative_area_level_1 ? tmp.administrative_area_level_1 : ''));
                inputs.postalCode.value = tmp.postal_code ? tmp.postal_code : '';
                inputs.country.value = autoCompleteCountry ? autoCompleteCountry.value : '';
            }
        });
    }
} else {
    console.warn("<maps_places_api_key> not defined for module AddressAutoComplete")
}
