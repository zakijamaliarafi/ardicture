<x-layout>
    <div class="ml-40 mb-16 w-2/3">
        <h1 class="text-3xl font-bold text-center">About Us</h1>
        <div class="flex mt-4">
            <div class="w-1/2">
                <img src="{{ asset('images/Ardicture-logo.png') }}" alt="" class="h-40">
                <h2 class="text-2xl">Welcome To Ardicture</h2>
                <p class="text-justify mt-2">Ardicture is a vibrant online community and platform where artists,
                    illustrators,
                    and photographers
                    from around the world can showcase their creative works. Our mission is to provide a space where
                    creativity thrives, and artists can connect, inspire, and be inspired.
                </p>
                <h2 class="text-2xl mt-4">Join Us!</h2>
                <p class="text-justify mt-2">Whether you're here to share your art, seek inspiration, or connect with
                    other artists, Ardicture welcomes you. Join our community today and be a part of something creative
                    and exciting!
                </p>
                <div class="w-full flex justify-center mt-2">
                    <button
                        class="px-5 py-1 mr-2 rounded-md border bg-orange-600 hover:bg-orange-900 text-white border-orange-600 self-center">
                        <a href="/register">Join Us!</a>
                    </button>
                </div>
            </div>
            <div class="w-1/2 ml-16">
                <h2 class="text-2xl mt-6">Our Vision</h2>
                <p class="mt-3">We believe in the power of art to transcend boundaries and bring people together.
                    Ardicture aims to
                    be the go-to destination for discovering and sharing amazing artwork, whether you're an aspiring
                    artist or an experienced professional.</p>
                <h2 class="text-2xl mt-6">What We Offer</h2>
                <ul class="list-disc ml-5 mt-3">
                    <li>Artwork Uploads: Share your creations with a global audience. Whether it’s digital art,
                        photography,
                        or illustrations, Ardicture is the perfect place to showcase your talent.</li>
                    <li>Community Engagement: Connect with fellow artists, receive feedback, and build your network. Our
                        community is supportive and passionate about art.</li>
                    <li>Inspiration and Discovery: Explore a vast collection of artworks from various genres and styles.
                        Find inspiration for your next project or simply enjoy the beauty of creativity</li>
                </ul>
                </p>
            </div>
        </div>
    </div>
    <x-footer />
</x-layout>
