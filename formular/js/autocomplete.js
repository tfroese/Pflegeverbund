async function fetchSuggestions() {
    const input = document.getElementById('postcode').value;
    if (input.length < 2) {
        document.getElementById('suggestions').innerHTML = '';
        return;
    }

    const response = await fetch(`https://zip-api.eu/de/DE-${input}`);
    if (response.ok) {
        const data = await response.json();
        displaySuggestions(data);
    } else {
        document.getElementById('suggestions').innerHTML = '';
    }
}

function displaySuggestions(data) {
    const suggestionsContainer = document.getElementById('suggestions');
    suggestionsContainer.innerHTML = '';

    data.forEach(place => {
        const suggestionDiv = document.createElement('div');
        suggestionDiv.textContent = `${place.plz} - ${place.ort} (${place.bundesland})`;
        suggestionDiv.addEventListener('click', () => selectSuggestion(suggestionDiv.textContent));
        suggestionsContainer.appendChild(suggestionDiv);
    });
}

function selectSuggestion(suggestion) {
    document.getElementById('postcode').value = suggestion;
    document.getElementById('suggestions').innerHTML = '';
}

// Keyboard navigation for suggestions
document.getElementById('postcode').addEventListener('keydown', function(e) {
    const suggestionsContainer = document.getElementById('suggestions');
    const active = suggestionsContainer.querySelector('.active');
    let newActive;
    if (e.key === 'ArrowDown') {
        if (active) {
            newActive = active.nextElementSibling || suggestionsContainer.firstElementChild;
            active.classList.remove('active');
        } else {
            newActive = suggestionsContainer.firstElementChild;
        }
    } else if (e.key === 'ArrowUp') {
        if (active) {
            newActive = active.previousElementSibling || suggestionsContainer.lastElementChild;
            active.classList.remove('active');
        } else {
            newActive = suggestionsContainer.lastElementChild;
        }
    } else if (e.key === 'Enter' && active) {
        e.preventDefault();
        selectSuggestion(active.textContent);
    }

    if (newActive) {
        newActive.classList.add('active');
    }
});
