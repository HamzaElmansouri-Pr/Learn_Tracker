

<?php $__env->startSection('title', 'Create Learning Item'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8 text-center">
        <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 via-cyan-600 to-teal-600 bg-clip-text text-transparent mb-2">
            ✨ Create Learning Item
        </h1>
        <p class="text-lg text-gray-600">Add a new item to your learning tracker 🚀</p>
    </div>

    <div class="bg-white rounded-2xl shadow-xl p-8 border-l-4 border-blue-500">
        <form method="POST" action="<?php echo e(route('learning-items.store')); ?>" class="space-y-6">
            <?php echo csrf_field(); ?>

            <div>
                <label for="title" class="block text-sm font-bold text-gray-700 mb-2">
                    📝 Title *
                </label>
                <input type="text" name="title" id="title" required 
                    class="block w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                    value="<?php echo e(old('title')); ?>" placeholder="e.g., Learn React Hooks">
                <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <span class="mr-1">⚠️</span> <?php echo e($message); ?>

                    </p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label for="description" class="block text-sm font-bold text-gray-700 mb-2">
                    📄 Description
                </label>
                <textarea name="description" id="description" rows="4" 
                    class="block w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                    placeholder="Describe what you want to learn..."><?php echo e(old('description')); ?></textarea>
                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <span class="mr-1">⚠️</span> <?php echo e($message); ?>

                    </p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label for="links" class="block text-sm font-bold text-gray-700 mb-2">
                    🔗 Links/Resources
                </label>
                <p class="text-xs text-gray-500 mb-2">Enter one link per line</p>
                <textarea name="links" id="links" rows="3" 
                    class="block w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all <?php $__errorArgs = ['links'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                    placeholder="https://example.com/resource1&#10;https://example.com/resource2"><?php echo e(old('links')); ?></textarea>
                <?php $__errorArgs = ['links'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <span class="mr-1">⚠️</span> <?php echo e($message); ?>

                    </p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="target_date" class="block text-sm font-bold text-gray-700 mb-2">
                        📅 Target Date
                    </label>
                    <input type="date" name="target_date" id="target_date" 
                        class="block w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all <?php $__errorArgs = ['target_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                        value="<?php echo e(old('target_date')); ?>">
                    <?php $__errorArgs = ['target_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <span class="mr-1">⚠️</span> <?php echo e($message); ?>

                        </p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label for="priority" class="block text-sm font-bold text-gray-700 mb-2">
                        ⚡ Priority
                    </label>
                    <select name="priority" id="priority" 
                        class="block w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        <option value="low" <?php echo e(old('priority') == 'low' ? 'selected' : ''); ?>>🟢 Low</option>
                        <option value="medium" <?php echo e(old('priority') == 'medium' ? 'selected' : ''); ?>>🟡 Medium</option>
                        <option value="high" <?php echo e(old('priority') == 'high' ? 'selected' : ''); ?>>🔴 High</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="week" class="block text-sm font-bold text-gray-700 mb-2">
                        📆 Week
                    </label>
                    <input type="number" name="week" id="week" min="1" 
                        class="block w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" 
                        value="<?php echo e(old('week')); ?>" placeholder="1">
                </div>

                <div>
                    <label for="day" class="block text-sm font-bold text-gray-700 mb-2">
                        📅 Day
                    </label>
                    <input type="text" name="day" id="day" 
                        class="block w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" 
                        placeholder="Monday" value="<?php echo e(old('day')); ?>">
                </div>

                <div>
                    <label for="time" class="block text-sm font-bold text-gray-700 mb-2">
                        ⏰ Time
                    </label>
                    <input type="time" name="time" id="time" 
                        class="block w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" 
                        value="<?php echo e(old('time')); ?>">
                </div>
            </div>

            <div class="flex justify-end space-x-4 pt-4">
                <a href="<?php echo e(route('learning-items.index')); ?>" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-3 rounded-xl font-semibold transition-all">
                    Cancel
                </a>
                <button type="submit" class="bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                    ✨ Create Item
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\profa\OneDrive\Desktop\tracker\cursor\resources\views/learning-items/create.blade.php ENDPATH**/ ?>