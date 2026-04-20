<!DOCTYPE html>
<html>
<head>
    <title>Video Call</title>
    <script src="https://meet.jit.si/external_api.js"></script>
</head>
<body style="margin:0;">

<div id="meet" style="height:100vh;"></div>

<script>
    const domain = "meet.jit.si";

    const options = {
        roomName: "{{ $room }}",
        width: "100%",
        height: "100%",
        parentNode: document.querySelector('#meet'),
        userInfo: {
            displayName: "{{ auth()->user()->name }}"
        }
    };

    const api = new JitsiMeetExternalAPI(domain, options);
</script>

</body>
</html>
