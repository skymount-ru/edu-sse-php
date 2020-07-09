const source = new EventSource('/sse.php');
const timeWidget = document.getElementById('timeWidget');
const sseStopControl = document.getElementById('sseStop');
/**
 * Stop SSE.
 */
sseStopControl.addEventListener('click', e => {
    source.close();
});
/**
 * Common event.
 */
source.onmessage = e => {
    timeWidget.innerText = JSON.parse(e.data).time;
};
/**
 * Special 'ping' event.
 */
source.addEventListener('ping', e => {
    timeWidget.innerText = 'Ping!';
});
/**
 * Error support.
 */
source.onerror = () => {
    timeWidget.innerText = 'Connection error. Retrying in 10 seconds.';
}
