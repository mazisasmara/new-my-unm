import { Chart, registerables } from 'chart.js';
import Sortable from 'sortablejs';

Chart.register(...registerables);

window.Chart = Chart;
window.Sortable = Sortable;

window.addEventListener('load', () => {
    window.dispatchEvent(new Event('app:ready'));
});