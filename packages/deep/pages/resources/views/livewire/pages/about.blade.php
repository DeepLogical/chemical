<div>
    <section class="relative">
        <div class="slide relative">
            <img src="/images/static/banners/about-us-web.jpg" alt="" class="web"/>
            <img src="/images/static/banners/about-us-mobile.jpg" alt="" class="mobile"/>
            <div class="absolute top-0 left-0 right-0 h-full flex flex-col items-center justify-center px-12 mx-0 md:mx-12 z-50">
                <h1 class="heading text-white text-center uppercase mb-3">About {{ config('deep.brand') }}</h1>
                <p class="paragraph text-white text-center">Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, reiciendis.</p>
            </div>
            <div class="tint"></div>
        </div>
    </section>
    <div class="container row">
        <div class="col-span-12 md:col-span-12 py-6 md:py-12">
            <h2 class="heading">Our Mission</h2>
            <p class="paragraph py-2 md:py-3">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aut sint nulla corporis eum voluptatum hic recusandae, eligendi quos beatae dolores inventore quod temporibus suscipit molestias aliquid eius praesentium quam repellendus?</p>
        </div>
        <div class="col-span-12 md:col-span-8">
            <h2 class="heading">Our Story</h2>
            <ul class="">
                <li class="paragraph card rounded-xl p-2 md:p-3 my-2 md:my-3">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolores porro quae dolore dolorem voluptatibus ab, quisquam asperiores doloribus qui! Omnis!</li>
                <li class="paragraph card rounded-xl p-2 md:p-3 my-2 md:my-3">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Necessitatibus iste atque quae, ullam eius neque tenetur officia reprehenderit beatae. Eligendi.</li>
            </ul>
        </div>
        <div class="col-span-12 md:col-span-4">
            <img src="/images/static/about-us.png" alt="">
        </div>        
    </div>
    <section class="py-6 md:py-12">
        <h2 class="heading text-center mb-3 md:mb-6">What We Offer</h2>
        <div class="container row">
            @foreach($services as $i)
            <div class="col-span-12 md:col-span-3 card p-2 md:p-3">
                    <div class="overflow-hidden">
                        <img src="/images/icons/services/{{$i['img']}}" alt="{{ $i['name'] }}" class="w-100 mx-auto" loading="lazy" width="60" height="60">
                    </div>
                    <h2 class="subHeading text-center my-2 md:my-3">{{$i['name']}}</h2>
                    <p class="paragraph text-center">{{$i['text']}}</p>
                </div>
            @endforeach
        </div>
    </section>
    <section class="py-6 md:py-12">
        <h2 class="heading text-center mb-3 md:mb-6">Meet the Team</h2>
        <div class="container row">
            @foreach($team as $i)
            <div class="col-span-12 md:col-span-3 group card p-2 md:p-3">
                    <div class="overflow-hidden">
                        <img src="/images/static/delete/{{$i['img']}}" alt="{{ $i['name'] }}" class="w-full mx-auto imgExpand" loading="lazy" width="60" height="60">
                    </div>
                    <h2 class="subHeading text-center my-1 md:my-2">{{$i['name']}}</h2>
                    <h2 class="paragraph font-bold text-center">{{$i['designation']}}</h2>
                    <p class="paragraph text-center my-2 md:my-3">{{$i['text']}}</p>
                </div>
            @endforeach
        </div>
    </section>
    <section class="py-6 md:py-12">
        <div class="container row">
            <div class="col-span-12 md:col-span-12">
                <h2 class="heading mb-3 md:mb-6">Who We Are ?</h2>
                <p class="paragraph my-2 md:my-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe quis, reiciendis, ad tempora adipisci, quidem sapiente debitis dolor explicabo dolores distinctio? Quo inventore similique aliquid iste expedita ipsam quasi ipsa. Quia ipsam placeat, minus a ducimus perspiciatis facilis temporibus, sed animi eaque at illo odio possimus atque! Dignissimos eligendi beatae cupiditate dolores impedit sequi aspernatur ut. Hic excepturi facilis ipsam quia fugit animi vitae ab officia praesentium consequatur, commodi eligendi ipsa at nihil, dolorem iure ad voluptate. Molestiae, debitis. Possimus est iure, earum minus totam accusantium quaerat beatae molestiae libero placeat voluptate commodi temporibus error autem cumque eum repudiandae vitae odio! Facilis atque molestias ducimus aperiam odit error labore commodi deleniti ipsam sunt, est quas maxime obcaecati, illo id quisquam sequi pariatur quam dicta eum. Libero perferendis sed praesentium magnam consequatur. Dolorem eveniet ad beatae odio cupiditate consequuntur, ratione minus vitae debitis quos veritatis accusamus a ab, eligendi, facilis ut.</p>
            </div>
            <div class="col-span-12 md:col-span-12">
                <h2 class="heading mb-3 md:mb-6">About Us</h2>
                <p class="paragraph my-2 md:my-3">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rem officiis quos quia incidunt labore quis voluptatibus natus aliquam? Sit, eius alias quia suscipit impedit quo nostrum ut rem placeat consequatur assumenda neque, illum fuga culpa obcaecati facere recusandae, commodi cum. Necessitatibus quo neque impedit doloremque fugit ullam hic illo alias optio deserunt quibusdam, laborum maxime mollitia praesentium vitae eos assumenda vero ea ratione quaerat, suscipit molestiae harum in! Pariatur voluptas ipsam aspernatur voluptates et, laudantium architecto facilis earum dolorem quae saepe voluptatum sint itaque. Veniam quasi, qui quibusdam modi cupiditate id assumenda. Reiciendis voluptate sunt rem placeat quam animi neque tempore tempora? Libero expedita doloribus aspernatur laudantium sapiente incidunt culpa quos aliquid sed consectetur perferendis necessitatibus architecto suscipit beatae, repellendus, vitae possimus dolor animi laborum. Natus soluta laudantium ullam tenetur totam. Rem, atque a, vero voluptatum obcaecati delectus quia consequatur mollitia omnis vitae aliquam hic fugiat recusandae sunt suscipit earum magni ea. Recusandae sapiente officiis rem nobis, nisi, fuga incidunt atque voluptate pariatur soluta eveniet optio necessitatibus ea architecto est voluptatum. Ullam similique fugiat, blanditiis illum culpa ipsum ad amet placeat, asperiores aliquid nemo, et quis quidem nesciunt voluptatibus laboriosam doloribus quae ea. Assumenda voluptas cumque dolor quas totam, architecto ratione animi aliquid est, perferendis natus. Consectetur dolorum ducimus a deleniti sapiente. Deserunt sint adipisci reprehenderit maxime corporis officiis temporibus iure. Quo reiciendis cupiditate voluptatibus pariatur libero ipsa accusantium quam vero porro non. Excepturi animi dolor officiis iure deserunt voluptas fugit ut dolorum, placeat est rerum totam labore alias corrupti? Voluptatibus ducimus quas rerum recusandae optio ipsum labore commodi doloremque! Omnis vitae veritatis recusandae in et voluptatibus corporis labore minima suscipit odio soluta rerum totam tenetur impedit quidem, eos minus sequi ipsa, laudantium, reiciendis commodi quae quibusdam porro ipsam. Reprehenderit fugit dolores explicabo ut cupiditate perferendis tenetur quaerat ad quam!</p>
            </div>
        </div>
    </section>
</div>

