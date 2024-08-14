<!-- resources/views/video-call.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Video Call</title>
</head>
<body>
    
    <div class=""><video id="localVideo" autoplay playsinline></video>
    <video id="remoteVideo" autoplay playsinline></video></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.11.3/dist/echo.iife.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        const localVideo = document.getElementById('localVideo');
        const remoteVideo = document.getElementById('remoteVideo');

        let localStream;
        let remoteStream;
        let peerConnection;

        const constraints = {
            video: true,
            audio: true
        };

        navigator.mediaDevices.getUserMedia(constraints)
            .then(stream => {
                localVideo.srcObject = stream;
                localStream = stream;
            });

        const configuration = {
            iceServers: [{
                urls: 'stun:stun.l.google.com:19302'
            }]
        };

        window.Echo.channel('video-call')
            .listen('Signal', (e) => {
                if (e.type === 'offer') {
                    peerConnection.setRemoteDescription(new RTCSessionDescription(e.offer));
                    peerConnection.createAnswer()
                        .then(answer => {
                            peerConnection.setLocalDescription(answer);
                            sendSignal({ 'type': 'answer', 'answer': answer });
                        });
                } else if (e.type === 'answer') {
                    peerConnection.setRemoteDescription(new RTCSessionDescription(e.answer));
                } else if (e.type === 'candidate') {
                    peerConnection.addIceCandidate(new RTCIceCandidate(e.candidate));
                }
            });

        function createPeerConnection() {
            peerConnection = new RTCPeerConnection(configuration);

            peerConnection.onicecandidate = ({ candidate }) => {
                if (candidate) {
                    sendSignal({ 'type': 'candidate', 'candidate': candidate });
                }
            };

            peerConnection.ontrack = (event) => {
                remoteVideo.srcObject = event.streams[0];
                remoteStream = event.streams[0];
            };

            localStream.getTracks().forEach(track => {
                peerConnection.addTrack(track, localStream);
            });
        }

        function sendSignal(data) {
            axios.post('/video-call/signal', data);
        }

        createPeerConnection();

        // Starting a call
        document.getElementById('startCall').addEventListener('click', () => {
            peerConnection.createOffer()
                .then(offer => {
                    peerConnection.setLocalDescription(offer);
                    sendSignal({ 'type': 'offer', 'offer': offer });
                });
        });
    </script>
</body>
</html>
