<style>
    
    .nav-link-active {
        background-color: rgb(207, 203, 203); /* Atur latar belakang sesuai kebutuhan */
        color: blue; /* Ubah warna teks menjadi biru */
    }


</style>

@props(['active' => false])

<a {{ $attributes->merge([
    'class' => $active ? 'nav-link-active' : 'bg-gray-200 text-black hover:bg-gray-300'
]) }}
   aria-current="{{ $active ? 'page' : false }}">
    {{ $slot }}
</a>

