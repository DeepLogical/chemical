<div class="px-12">
    @livewire('adminSearch', ['page' => 'Admin Dashboard', 'routeName' => '', 'routeText' => 'Admin Dashboard', 'link' => ''])
    <div class="row">
        <div class="col-span-12 md:col-span-4 deepShadow p-5 h-full">
            <h2 class="text-xl mb-5">Users</h2>
            <div class="flex items-center justify-between">
                <p><strong>Total</strong></p>
                <p>{{ $totalUsers}}</p>
            </div>
            <div class="flex items-center justify-between">
                <p><strong>Verified</strong></p>
                <p>{{ $verifiedUsers}}</p>
            </div>
            <div class="flex items-center justify-between">
                <p><strong>UnVerified</strong></p>
                <p>{{ $unverifiedUsers}}</p>
            </div>
        </div>
        <div class="col-span-12 md:col-span-4 deepShadow p-5 h-full">
            <h2 class="text-xl mb-5">Comments</h2>
            <div class="flex items-center justify-between">
                <p><strong>Total</strong></p>
                <p>{{ $totalComments}}</p>
            </div>
        </div>
        <div class="col-span-12 md:col-span-4 deepShadow p-5 h-full">
            <h2 class="text-xl mb-5">Blogs</h2>
            <div class="flex items-center justify-between">
                <p><strong>Total</strong></p>
                <p>{{ $totalBlog}}</p>
            </div>
        </div>
    </div>
</div>