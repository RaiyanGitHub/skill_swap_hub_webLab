<x-app-layout>

<div class="p-6 text-white">

    <h2 class="mb-4">Chat with {{ $user->name }}</h2>

    <div id="chatBox" class="h-80 overflow-y-auto bg-white/5 p-3 rounded"></div>

    <div class="mt-3 flex gap-2">
        <input id="msg" class="flex-1 text-black px-2 py-1 rounded" placeholder="Type...">
        <button onclick="sendMsg()" class="bg-blue-500 px-3 rounded">Send</button>
    </div>

</div>

<script>
const userId = {{ $user->id }};

function loadMessages() {
    fetch(`/chat/fetch/${userId}`)
        .then(res => res.json())
        .then(data => {

            let html = '';

            data.forEach(m => {
                html += `<div>
                    <b>${m.sender_id == {{ auth()->id() }} ? 'Me' : 'Them'}:</b>
                    ${m.message}
                </div>`;
            });

            document.getElementById('chatBox').innerHTML = html;
        });
}

function sendMsg() {
    fetch('/chat/send', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            receiver_id: userId,
            message: document.getElementById('msg').value
        })
    });

    document.getElementById('msg').value = '';
}

// 🔁 polling
setInterval(loadMessages, 2000);

loadMessages();
</script>

</x-app-layout>
