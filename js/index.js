document.querySelector("form").addEventListener("submit", function(e) {
    const fields = ["tv", "radio", "newspaper"];
    let valid = true;

    fields.forEach(field => {
        const value = document.querySelector(`[name="${field}"]`).value;
        if (value <= 0 || isNaN(value)) {
            alert(`${field.toUpperCase()} muss eine positive Zahl sein!`);
            valid = false;
        }
    });

    if (!valid) e.preventDefault();
});
