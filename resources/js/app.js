import './bootstrap';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';

// Make FullCalendar available globally
window.FullCalendar = {
    Calendar: Calendar,
    dayGridPlugin: dayGridPlugin,
    timeGridPlugin: timeGridPlugin,
    interactionPlugin: interactionPlugin
};

