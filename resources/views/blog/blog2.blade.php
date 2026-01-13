<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kebiasaan Tidur yang Lebih Baik | YoMooD</title>
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
        <img src="{{ asset('images/blog/blog2.png') }}" alt="Gambar Blog 2" class="w-72 h-72 object-cover rounded-lg mx-auto shadow-lg">
    </div>

    <h1 class="text-3xl font-bold text-black mb-4 text-center">Kebiasaan Tidur yang Lebih Baik</h1>

    <p class="text-gray-700 mb-4">
        Tidur yang berkualitas bukan hanya soal berapa lama kamu tidur, tapi seberapa dalam dan tenang tidurmu. 
        Banyak orang tidak menyadari bahwa kualitas tidur yang buruk bisa berdampak besar pada suasana hati, konsentrasi, bahkan sistem kekebalan tubuh.
    </p>

    <p class="text-gray-700 mb-4">
        Untuk memperbaikinya, cobalah membuat rutinitas tidur yang konsisten. 
        Tidur dan bangun di jam yang sama setiap hari membantu tubuh membentuk ritme sirkadian yang sehat. 
        Hindari layar ponsel atau laptop setidaknya 30 menit sebelum tidur karena cahaya biru bisa menipu otakmu agar tetap terjaga.
    </p>

    <p class="text-gray-700 mb-4">
        Selain itu, ciptakan suasana kamar yang nyaman. Gunakan lampu redup, matikan suara bising, dan pastikan suhu ruangan sejuk. 
        Kamar yang bersih dan rapi juga membantu otak merasa lebih tenang sebelum beristirahat.
    </p>

    <p class="text-gray-700 mb-4">
        Jangan lupa, kebiasaan di siang hari juga berpengaruh pada malam hari. 
        Olahraga ringan di pagi hari, minum cukup air, dan menghindari kafein di sore hari bisa membuat tidurmu lebih nyenyak.
    </p>

    <div class="text-center mt-8">
        <a href="{{ route('blog') }}" class="bg-black text-yellow-400 px-5 py-2 rounded hover:bg-yellow-400 hover:text-black transition">← Kembali ke Blog</a>
    </div>
</div>

</body>
</html>
