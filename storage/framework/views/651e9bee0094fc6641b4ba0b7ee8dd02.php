

<?php $__env->startSection('title', $learningItem->title); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 via-cyan-600 to-teal-600 bg-clip-text text-transparent">
                <?php echo e($learningItem->title); ?>

            </h1>
            <p class="mt-2 text-gray-600 text-lg">Learning Item Details</p>
        </div>
        <div class="flex space-x-3">
            <a href="<?php echo e(route('learning-items.edit', $learningItem)); ?>" class="bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white px-4 py-2 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all">
                ✏️ Edit
            </a>
            <form method="POST" action="<?php echo e(route('learning-items.toggle-complete', $learningItem)); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white px-4 py-2 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all">
                    <?php echo e($learningItem->is_completed ? '↩️ Mark Incomplete' : '✅ Mark Complete'); ?>

                </button>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-xl p-8 mb-6 border-l-4 border-blue-500">
        <div class="space-y-6">
            <?php if($learningItem->description): ?>
                <div class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl p-6">
                    <h3 class="text-lg font-bold text-gray-700 mb-3 flex items-center">
                        <span class="mr-2">📄</span> Description
                    </h3>
                    <p class="text-gray-900 leading-relaxed"><?php echo e($learningItem->description); ?></p>
                </div>
            <?php endif; ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl p-6">
                    <h3 class="text-sm font-bold text-gray-700 mb-2 flex items-center">
                        <span class="mr-2">📅</span> Target Date
                    </h3>
                    <p class="text-2xl font-bold text-gray-900">
                        <?php echo e($learningItem->target_date ? $learningItem->target_date->format('F d, Y') : 'Not set'); ?>

                    </p>
                </div>

                <div class="bg-gradient-to-r from-yellow-50 to-orange-50 rounded-xl p-6">
                    <h3 class="text-sm font-bold text-gray-700 mb-2 flex items-center">
                        <span class="mr-2">⚡</span> Priority
                    </h3>
                    <span class="inline-block px-4 py-2 text-sm font-bold rounded-full 
                        <?php echo e($learningItem->priority === 'high' ? 'bg-gradient-to-r from-red-100 to-pink-100 text-red-800' : ($learningItem->priority === 'medium' ? 'bg-gradient-to-r from-yellow-100 to-orange-100 text-yellow-800' : 'bg-gradient-to-r from-green-100 to-emerald-100 text-green-800')); ?>">
                        <?php echo e(ucfirst($learningItem->priority)); ?>

                    </span>
                </div>

                <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-6">
                    <h3 class="text-sm font-bold text-gray-700 mb-2 flex items-center">
                        <span class="mr-2">📊</span> Status
                    </h3>
                    <?php if($learningItem->is_completed): ?>
                        <span class="inline-block px-4 py-2 text-sm font-bold rounded-full bg-gradient-to-r from-green-100 to-emerald-100 text-green-800">
                            ✅ Completed on <?php echo e($learningItem->completed_at->format('M d, Y')); ?>

                        </span>
                    <?php else: ?>
                        <span class="inline-block px-4 py-2 text-sm font-bold rounded-full bg-gradient-to-r from-gray-100 to-slate-100 text-gray-800">
                            ⏳ Pending
                        </span>
                    <?php endif; ?>
                </div>

                <?php if($learningItem->week || $learningItem->day || $learningItem->time): ?>
                    <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl p-6">
                        <h3 class="text-sm font-bold text-gray-700 mb-2 flex items-center">
                            <span class="mr-2">⏰</span> Schedule
                        </h3>
                        <p class="text-lg font-semibold text-gray-900">
                            <?php if($learningItem->week): ?> Week <?php echo e($learningItem->week); ?> <?php endif; ?>
                            <?php if($learningItem->day): ?> <?php echo e($learningItem->day); ?> <?php endif; ?>
                            <?php if($learningItem->time): ?> at <?php echo e(\Carbon\Carbon::parse($learningItem->time)->format('g:i A')); ?> <?php endif; ?>
                        </p>
                    </div>
                <?php endif; ?>
            </div>

            <?php if(!empty($learningItem->links) && is_array($learningItem->links) && count($learningItem->links) > 0): ?>
                <div class="bg-gradient-to-r from-cyan-50 to-blue-50 rounded-xl p-6">
                    <h3 class="text-lg font-bold text-gray-700 mb-4 flex items-center">
                        <span class="mr-2">🔗</span> Resources & Links
                    </h3>
                    <ul class="space-y-3">
                        <?php $__currentLoopData = $learningItem->links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a href="<?php echo e($link); ?>" target="_blank" class="flex items-center text-blue-600 hover:text-blue-800 bg-white px-4 py-3 rounded-lg hover:shadow-md transition-all">
                                    <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                    <span class="truncate"><?php echo e($link); ?></span>
                                </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="flex justify-end">
        <form method="POST" action="<?php echo e(route('learning-items.destroy', $learningItem)); ?>" onsubmit="return confirm('Are you sure you want to delete this learning item?');">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit" class="bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all">
                🗑️ Delete Item
            </button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\profa\OneDrive\Desktop\tracker\cursor\resources\views/learning-items/show.blade.php ENDPATH**/ ?>