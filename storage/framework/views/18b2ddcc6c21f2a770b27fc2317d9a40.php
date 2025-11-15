

<?php $__env->startSection('title', $examModule->module_name); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900"><?php echo e($examModule->module_name); ?></h1>
            <p class="mt-2 text-gray-600">Exam Preparation Schedule</p>
        </div>
        <div class="flex space-x-3">
            <a href="<?php echo e(route('exams.edit', $examModule)); ?>" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium">
                Edit
            </a>
            <form method="POST" action="<?php echo e(route('exams.toggle-complete', $examModule)); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium">
                    <?php echo e($examModule->is_completed ? 'Mark Incomplete' : 'Mark Complete'); ?>

                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-sm font-medium text-gray-500 mb-2">Exam Date</h3>
            <p class="text-2xl font-bold text-gray-900"><?php echo e($examModule->exam_date->format('F d, Y')); ?></p>
            <p class="text-sm text-gray-500 mt-1"><?php echo e($examModule->daysUntilExam()); ?> days remaining</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-sm font-medium text-gray-500 mb-2">Time Required</h3>
            <p class="text-2xl font-bold text-gray-900"><?php echo e($examModule->time_required); ?> hours</p>
            <p class="text-sm text-gray-500 mt-1">Total preparation time</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6 <?php echo e($examModule->isUrgent() ? 'bg-red-50 border-2 border-red-200' : ''); ?>">
            <h3 class="text-sm font-medium text-gray-500 mb-2">Status</h3>
            <?php if($examModule->isUrgent()): ?>
                <p class="text-2xl font-bold text-red-600">Urgent</p>
                <p class="text-sm text-red-500 mt-1">Less than 7 days remaining</p>
            <?php else: ?>
                <p class="text-2xl font-bold text-gray-900">On Track</p>
                <p class="text-sm text-gray-500 mt-1">Adequate time remaining</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow mb-6">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Generated Study Schedule</h2>
            <p class="text-sm text-gray-500 mt-1">Suggested study sessions leading up to the exam</p>
        </div>
        <div class="p-6">
            <?php if(count($studySchedule) > 0): ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hours</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php $__currentLoopData = $studySchedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="<?php echo e($session['is_urgent'] ? 'bg-red-50' : ''); ?>">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <?php echo e(\Carbon\Carbon::parse($session['date'])->format('F d, Y')); ?>

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo e($session['hours']); ?> hours
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php if($session['is_urgent']): ?>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Urgent
                                            </span>
                                        <?php else: ?>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                Scheduled
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="text-gray-500 text-center py-4">No study schedule available</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Study Sessions</h2>
        </div>
        <div class="p-6">
            <?php if($sessions->count() > 0): ?>
                <div class="space-y-4">
                    <?php $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div>
                                <p class="font-medium text-gray-900">
                                    <?php echo e($session->scheduled_date->format('F d, Y')); ?>

                                </p>
                                <p class="text-sm text-gray-500">
                                    <?php echo e(\Carbon\Carbon::parse($session->scheduled_time)->format('g:i A')); ?> - 
                                    <?php echo e(\Carbon\Carbon::parse($session->scheduled_time)->addMinutes($session->duration)->format('g:i A')); ?>

                                    (<?php echo e($session->duration); ?> minutes)
                                </p>
                            </div>
                            <div>
                                <?php if($session->is_completed): ?>
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Completed
                                    </span>
                                <?php else: ?>
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                        Pending
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <p class="text-gray-500 text-center py-4">No study sessions scheduled</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\profa\OneDrive\Desktop\tracker\cursor\resources\views/exams/show.blade.php ENDPATH**/ ?>