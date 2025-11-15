

<?php $__env->startSection('title', 'Calendar'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8 text-center">
        <h1 class="text-4xl font-bold bg-gradient-to-r from-green-600 via-emerald-600 to-teal-600 bg-clip-text text-transparent mb-2">
            📅 Calendar
        </h1>
        <p class="text-lg text-gray-600">View and manage your learning schedule ✨</p>
    </div>

    <div class="bg-white rounded-2xl shadow-xl p-6 border-l-4 border-green-500">
        <div id="calendar" class="min-h-[600px]"></div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    
    // Check if FullCalendar is available
    if (typeof FullCalendar !== 'undefined' && FullCalendar.Calendar) {
        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [FullCalendar.dayGridPlugin, FullCalendar.timeGridPlugin, FullCalendar.interactionPlugin],
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: '<?php echo e(route("calendar.events")); ?>',
            editable: true,
            droppable: true,
            eventDrop: function(info) {
                if (info.event.extendedProps.type === 'session') {
                    fetch('<?php echo e(url("/calendar/sessions")); ?>/' + info.event.extendedProps.item_id, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            scheduled_date: info.event.startStr.split('T')[0],
                            scheduled_time: info.event.startStr.split('T')[1] || '09:00:00',
                            duration: 60
                        })
                    });
                }
            },
            eventClick: function(info) {
                if (info.event.extendedProps.type === 'learning_item') {
                    window.location.href = '/learning-items/' + info.event.extendedProps.item_id;
                } else if (info.event.extendedProps.type === 'exam') {
                    window.location.href = '/exams/' + info.event.extendedProps.item_id;
                }
            },
            eventClassNames: function(arg) {
                return ['hover-lift'];
            }
        });
        calendar.render();
    } else {
        // Fallback if FullCalendar is not loaded
        calendarEl.innerHTML = '<div class="text-center p-12"><div class="text-6xl mb-4">📅</div><p class="text-gray-500 text-lg">Loading calendar...</p><p class="text-sm text-gray-400 mt-2">If this message persists, please ensure FullCalendar is properly installed.</p></div>';
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\profa\OneDrive\Desktop\tracker\cursor\resources\views/calendar/index.blade.php ENDPATH**/ ?>