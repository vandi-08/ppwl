<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Panduan Menghentikan Kebiasaan Buruk | YoMooD</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-yellow-50 text-gray-900 flex flex-col min-h-screen">

<!-- Navbar -->
<div class="flex justify-between items-center bg-black text-yellow-400 px-8 py-4 shadow-lg">
    <div class="flex items-center gap-2">
        <a href="/">
            <img id="logo" src="{{ asset('images/logo.png') }}" alt="YoMooD Logo" class="w-8 h-8 hover:scale-110 transition cursor-pointer">
        </a>
        <a href="/" class="text-xl font-bold hover:text-white transition">YoMooD</a>
    </div>
    <div class="space-x-6">
        <a href="/blog" class="text-yellow-400 hover:text-white font-semibold">Blog</a>
        <a href="/login" class="bg-yellow-400 text-black px-3 py-1 rounded hover:bg-yellow-300 transition">Login</a>
    </div>
</div>

<!-- Blog -->
<div class="max-w-3xl mx-auto my-12 p-6 bg-white shadow-lg rounded-lg">
    <div class="relative mb-6">
        <div class="absolute -inset-2 bg-yellow-300 rounded-lg -z-10"></div>
        <img src="{{ asset('images/blog/blog3.png') }}" alt="Gambar Blog 3" class="w-72 h-72 object-cover rounded-lg mx-auto shadow-lg">
    </div>

    <h1 class="text-3xl font-bold text-black mb-4 text-center">Panduan Menghentikan Kebiasaan Buruk</h1>

    <p class="text-gray-700 mb-4">
        Setiap orang pasti punya kebiasaan buruk yang sulit dihentikan. 
        Entah itu menunda pekerjaan, sering scrolling media sosial tanpa sadar, atau kebiasaan begadang. 
        Kunci pertama untuk mengubahnya adalah kesadaran diri — menyadari bahwa perilaku tersebut benar-benar merugikanmu.
    </p>

    <p class="text-gray-700 mb-4">
        Setelah itu, jangan langsung berusaha menghapus kebiasaan tersebut sepenuhnya. 
        Otak manusia tidak suka perubahan drastis. 
        Gantilah perlahan dengan kebiasaan baru yang lebih sehat dan realistis. 
        Misalnya, jika kamu sering begadang, mulailah tidur 15 menit lebih awal setiap malam.
    </p>

    <p class="text-gray-700 mb-4">
        Buat catatan kecil untuk melacak kemajuanmu. 
        Dengan melihat progres harian, kamu akan merasa lebih termotivasi. 
        Ingatlah bahwa setiap perubahan kecil adalah kemenangan.
    </p>

    <p class="text-gray-700 mb-4">
        Terakhir, berikan penghargaan untuk diri sendiri. 
        Kamu tidak perlu menunggu sampai benar-benar sempurna. 
        Setiap usaha menuju versi dirimu yang lebih baik layak dirayakan.
    </p>

    <div class="text-center mt-8">
        <a href="{{ route('blog') }}" class="bg-black text-yellow-400 px-5 py-2 rounded hover:bg-yellow-400 hover:text-black transition">← Kembali ke Blog</a>
    </div>
</div>

</body>
</html>
