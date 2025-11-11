const form = document.getElementById('leadForm');
const modal = document.getElementById('responseModal');
const responseContent = document.getElementById('responseContent');

form.addEventListener('submit', function(e) {
    e.preventDefault();

    const ZipCode = form.ZipCode.value.trim();

    if (ZipCode && !/^\d{5}$/.test(ZipCode)) {
        alert("Zip code must be exactly 5 digits");
        return;
    }

    const formData = new FormData(form);

    fetch('process.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === "success") {
            responseContent.innerHTML = `<p style="color:green; font-weight:bold;">${data.message}</p>`;
        } else {
            responseContent.innerHTML = `<p style="color:red; font-weight:bold;">${data.message}</p>`;
        }
        modal.style.display = 'flex';
    })
    .catch(err => {
        responseContent.innerHTML = `<p style="color:red; font-weight:bold;">Error: ${err}</p>`;
        modal.style.display = 'flex';
    });
});
