<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ringba Lead Form</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h2>Ringba Lead Form</h2>
    <form id="leadForm">
        <div class="form-group">
            <input type="text" name="CID" placeholder=" " autocomplete="off">
            <label>Campaign ID (CID)</label>
        </div>

        <div class="form-group">
            <input type="text" name="ZipCode" placeholder=" " pattern="\d{5}" title="Zip code must be 5 digits" autocomplete="off">
            <label>Zip Code (5 digits)</label>
        </div>

        <div class="form-group">
            <input type="text" name="State" placeholder=" " autocomplete="off">
            <label>State</label>
        </div>

        <input type="hidden" id="leadid_token" name="leadid_token" value="" />

        <button type="submit">Submit Form</button>
    </form>
</div>

<div id="responseModal">
    <div class="card">
        <h2>API Response</h2>
        <div id="responseContent"></div>
        <a href="#" onclick="document.getElementById('responseModal').style.display='none';return false;">Close</a>
    </div>
</div>

<script type="text/javascript">
function myCallbackFunction(token) {
    var field = document.getElementById("leadid_token");
    if (field) {
        field.setAttribute('value', token);
    }
}
</script>

<script id="LeadiDscript" type="text/javascript">
(function() {
    var s = document.createElement('script');
    s.id = 'LeadiDscript_campaign';
    s.type = 'text/javascript';
    s.async = true;
    s.src = '//create.lidstatic.com/campaign/e464447a-669b-6681-af23-8369b358b84c.js?snippet_version=2&callback=myCallbackFunction';
    var LeadiDscript = document.getElementById('LeadiDscript');
    LeadiDscript.parentNode.insertBefore(s, LeadiDscript);
})();
</script>

<noscript>
    <img src="//create.leadid.com/noscript.gif?lac=643B9470-BEEE-94A1-40BE-69DF63A2B0CA&lck=e464447a-669b-6681-af23-8369b358b84c&snippet_version=2&callback=myCallbackFunction" />
</noscript>

<script src="js/main.js"></script>
</body>
</html>
