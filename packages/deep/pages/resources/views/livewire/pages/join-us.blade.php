<div class="container py-12">
    <style>
        blockquote {
            border-left: 10px solid #ad2e24;
            border-right: 10px solid #ad2e24;
            margin: 1.5em 10px;
            padding: .5em 5px;
            width: fit-content;
            display: inline-block;
            line-height: 2em;
        }
        blockquote:before, blockquote:after {
            color: #ad2e24;
            font-size: 3em;
            line-height: .1em;
            vertical-align: -.4em;
        }
        blockquote:before {
            content: open-quote;
        }
        blockquote:after {
            content: close-quote;
        }
    </style>
    <h1 class="heading">Looking for a career with Us?</h1>
    <p class="text-center">If you are looking to make a career in website development or digital marketing, join us.</p>
    <div class="p-5 mb-5 card">
        <h2 class="font-bold text-xl md:text-3xl">Content Writer</h2>
        <p>Pay: &#8377;{{ (int) ceil( 5000 ) }} - {{ (int) ceil( 15000 ) }} a month</p>
        <p>Experience: 0-5 years</p>
        <p>The roles and responsibility will be:</p>
        <ul class="pl-4">
            <li>Create high engaging content for blogs and articles </li>
            <li>Content Planning as per objectives</li>
            <li>Proof read existing content on website </li>
            <li>Work with creative team to develop collaterals</li>
        </ul>
        <blockquote>Send your resume on <strong>{{ config('deep.email') }}</strong> with subject - "<strong>Applying for Content Writing </strong>"</blockquote>
    </div>

    <form wire:submit.prevent="submit" method="POST"  autocomplete="off" class="card p-3">
        <h2 class="heading">Please fill the form and we will reach back to you.</h2>
        <div class="row">
            <div class="mb-3 col-span-12 md:col-span-4">
                <label for="name" class="formLabel">Name *</label>
                <input type="text" wire:model="name" class="formInput" placeholder="Full Name" required>
                @error('name') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3 col-span-12 md:col-span-4">
                <label for="name" class="formLabel">Email *</label>
                <input type="email" wire:model="email" class="formInput" placeholder="Email ID" required>
                @error('email') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3 col-span-12 md:col-span-4">
                <label for="name" class="formLabel">Phone *</label>
                <input type="number" wire:model="phone" class="formInput" placeholder="Phone Number" required>
                @error('phone') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3 col-span-12 md:col-span-6">
                <label for="name" class="formLabel">Resume *</label>
                <input type="file" wire:model="resume" class="formInput" required>
                @error('resume') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3 col-span-12 md:col-span-6">
                <label for="name" class="formLabel">Cover</label>
                <input type="file" wire:model="cover" class="formInput">
                @error('cover') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3 col-span-12">
                <label for="name" class="formLabel">Subject *</label>
                <input type="text" wire:model="subject" class="formInput" placeholder="Subject" required>
                @error('subject') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3 col-span-12">
                <label for="name" class="formLabel">Message</label>
                <textarea type="text" wire:model="message" class="h-40 formInput" placeholder="Your Message"></textarea>
                @error('message') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="col-span-12 text-center">
                <button type="submit" class="btn w-full" wire:loading.remove>Submit</button>
                <span wire:loading class="btn w-full">Submit</span>
            </div>
        </div>
    </form>
</div>