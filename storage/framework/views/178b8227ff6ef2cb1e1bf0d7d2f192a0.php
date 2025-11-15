

<?php $__env->startSection('title', 'Learning Items'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 via-cyan-600 to-teal-600 bg-clip-text text-transparent">
                📖 Learning Items
            </h1>
            <p class="mt-2 text-gray-600 text-lg">Manage your learning goals and track progress ✨</p>
        </div>
        <a href="<?php echo e(route('learning-items.create')); ?>" class="bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
            ✨ Add New Item
        </a>
    </div>

    <?php if($learningItems->count() > 0): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__currentLoopData = $learningItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white rounded-2xl shadow-xl hover-lift p-6 border-l-4 <?php echo e($item->is_completed ? 'border-green-500 opacity-75' : ($item->priority === 'high' ? 'border-red-500' : ($item->priority === 'medium' ? 'border-yellow-500' : 'border-blue-500'))); ?>">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-xl font-bold text-gray-900 flex-1 pr-2"><?php echo e($item->title); ?></h3>
                        <form method="POST" action="<?php echo e(route('learning-items.toggle-complete', $item)); ?>" class="ml-2">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="text-3xl transform hover:scale-125 transition-transform">
                                <?php echo $item->is_completed ? '✅' : '⭕'; ?>

                            </button>
                        </form>
                    </div>
                    
                    <?php if($item->description): ?>
                        <p class="text-gray-600 mb-4 line-clamp-2 text-sm"><?php echo e($item->description); ?></p>
                    <?php endif; ?>

                    <div class="space-y-3 mb-4">
                        <?php if($item->target_date): ?>
                            <div class="flex items-center text-sm text-gray-600 bg-purple-50 px-3 py-2 rounded-lg">
                                <span class="mr-2">📅</span>
                                <span class="font-medium"><?php echo e($item->target_date->format('M d, Y')); ?></span>
                            </div>
                        <?php endif; ?>

                        <div class="flex items-center justify-between">
                            <span class="px-4 py-2 text-xs font-bold rounded-full 
                                <?php echo e($item->priority === 'high' ? 'bg-gradient-to-r from-red-100 to-pink-100 text-red-800' : ($item->priority === 'medium' ? 'bg-gradient-to-r from-yellow-100 to-orange-100 text-yellow-800' : 'bg-gradient-to-r from-green-100 to-emerald-100 text-green-800')); ?>">
                                <?php echo e(ucfirst($item->priority)); ?> Priority
                            </span>
                            <?php if($item->is_completed): ?>
                                <span class="px-4 py-2 text-xs font-bold rounded-full bg-gradient-to-r from-green-100 to-emerald-100 text-green-800">
                                    ✅ Completed
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if(!empty($item->links) && is_array($item->links) && count($item->links) > 0): ?>
                        <div class="mb-4 bg-blue-50 rounded-lg p-3">
                            <p class="text-xs font-semibold text-gray-700 mb-2">🔗 Resources:</p>
                            <div class="flex flex-wrap gap-2">
                                <?php $__currentLoopData = array_slice($item->links, 0, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e($link); ?>" target="_blank" class="text-xs text-blue-600 hover:text-blue-800 truncate max-w-xs bg-white px-2 py-1 rounded">
                                        🔗 Link
                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="flex space-x-2 mt-4">
                        <a href="<?php echo e(route('learning-items.show', $item)); ?>" class="flex-1 bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white px-4 py-2 rounded-xl text-center text-sm font-semibold shadow-md hover:shadow-lg transition-all">
                            👁️ View
                        </a>
                        <a href="<?php echo e(route('learning-items.edit', $item)); ?>" class="flex-1 bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white px-4 py-2 rounded-xl text-center text-sm font-semibold shadow-md hover:shadow-lg transition-all">
                            ✏️ Edit
                        </a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <div class="bg-white rounded-2xl shadow-xl p-12 text-center">
            <div class="text-8xl mb-6 float-animation">📚</div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">No learning items yet</h3>
            <p class="text-gray-500 mb-6">Get started by creating your first learning item! 🚀</p>
            <a href="<?php echo e(route('learning-items.create')); ?>" class="inline-flex items-center px-6 py-3 border border-transparent shadow-lg text-base font-bold rounded-xl text-white bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 hover:from-blue-600 hover:via-purple-600 hover:to-pink-600 transition-all duration-200 transform hover:scale-105">
                ✨ Add Learning Item
            </a>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\profa\OneDrive\Desktop\tracker\cursor\resources\views/learning-items/index.blade.php ENDPATH**/ ?>