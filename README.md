Repository ini berisi tentang hasil belajar dari matakuliah pemrograman framework. 
pada project ini kami saling bekerja sama dalam berusaha mengembangkan sesuatu yang dapat berguna untuk kami dan seluruh pihak yang terlibat.
terimakasih kepada seluruh pihak yang telah meluangkan waktunya untuk belajar bersama membangun dengan baik. 
untuk semua developer yang terlibat ciyee developer... 

1. Farida Wijayanti (18050623012)
2. Ega Wahyu Cahyono (18050623014)
3. Mia Nurvia Raya (18050623015)
4. Amelia Febrianti W. (18050623021)
5. Wenny Prastiwi (18050623024)
6. Dardiri Novar Reviansyah (18050623026)


---------------------------- Langkah-langkah Clone Repo -----------------------------------

1. Pastikan sudah punya github (Buat jika belum)
2. Pastikan punya akses ke repo karena ini private (Minta wenny jika belum diberi)
3. Dibagian code ada button berwarna hijau bertuliskan "Code"
4. Klik button tersebut , lalu salin link.
5. Buka cmd arahkan ke folder yang kalian mau
6. ketik git clone "link yang dicopy" (diwindows klik kanan aja nanti langsung terpaste)
7. Tunggu hingga proses selesai.
8. Done , buka hasil clone dengan code editor (saran gunakan vscode karena ada terminal).

-------------------------------------------------------------------------------------------



---------------------------- Langkah-langkah Kontribusi -----------------------------------

Lakukan langkah clone dulu. (WAJIB)

	1. Git Push ( Input perubahan dari folder local ke github )
		a. Pastikan kalian sudah melakukan perubahan pada project.
		b. buka cmd pada folder project / terminal jika pakai vscode (ctrl + `)
		c. pertama "git pull origin master" , lakukan di awal berjaga-jaga supaya jika ada commit dari yang lain.
		d. kedua "git add ." ("." artinya all file di project, bisa spesifik nama file. cth : git add inifile.php)
		e. lalu "git commit -m "pesan commit" (Pesan commit itu adalah pesan untuk memberi tahu perubahan apa yang dilakukan)
		f. terakhir "git push origin master" , dan tunggu proses selesai.

	2. Git Pull ( Mengambil perubahan yang ada di github ) 
		a. Buka project yang sudah di clone
		b. buka cmd pada folder project / terminal jika pakai vscode (ctrl + `)
		c. lalu ketik "git pull origin master"
		d. Tunggu proses selesai.
        
    3. Git Push Branch (Push ke github dengan branch)
        a. git checkout -b feature/namaprojekbagian/namaanda/tglbulantahun
        b. Contoh  : git checkout -b feature/admin/wenny/25112020
        c. git add sama seperti biasanya
        d. git commit -m "namaandatglbulantahun isi pesan" , contoh : git commit -m "wenny25112020 ini pesan commit"
        e. git push origin nama branch , contoh : git push origin feature/admin/wenny/25112020
        f. gunakan -f jika mau push lebih dari 1 kali di branch yang sama , contoh : git push -f origin feature/admin/wenny/25112020
        (noted : Selalu buat branch baru setiap ganti hari , jangan hapus branch lama , jangan push dengan branch lama kecuali ada error pada branch lama) 

-------------------------------------------------------------------------------------------





----------------------- Langkah-langkah Awal Menjalankan Aplikasi --------------------------

	1. Buka CMD di drectory project
	2. Migrate DB dengan cara ketik "php artisan migrate" dan tekan enter
	3. Jalankan seed untuk agama dengan ketik "php artisan db:seed" dan tekan enter
	4. Jalankan seed untuk lokasi indonesia dengan ketik "php artisan laravolt:indonesia:seed" dan enter

-------------------------------------------------------------------------------------------


----------------------- Langkah-langkah Awal Menjalankan Api  ------------------------------
	1. php artisan passport::install
    
    
    
    
    
----------------------- Menampilkan thumbnail  ------------------------------    
    ![thumbnailframework](thumbnailframework.png?raw=true)
