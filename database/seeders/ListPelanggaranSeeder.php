<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ListPelanggaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data pelanggaran dan poin
        $pelanggaran = [
            ['nama_pelanggaran' => 'Terlambat ibadah pagi', 'poin' => 1],
            ['nama_pelanggaran' => 'Terlambat melaksanakan tugas piket kebersihan.', 'poin' => 1],
            ['nama_pelanggaran' => 'Terlambat keluar asrama.', 'poin' => 1],
            ['nama_pelanggaran' => 'Tidak mandi pada saat berangkat makan ke kantin dan mengikuti kegiatan akademik', 'poin' => 1],
            ['nama_pelanggaran' => 'Menyimpan gantungan pakaian di lemari melebihi jumlah yang ditentukan', 'poin' => 1],
            ['nama_pelanggaran' => 'Menyimpan peralatan kebersihan bermalam di kamar', 'poin' => 1],
            ['nama_pelanggaran' => 'Tidak melaporkan/membiarkan kerusakan fasilitas asrama', 'poin' => 1],
            ['nama_pelanggaran' => 'Meninggalkan peralatan menyetrika dengan tidak rapi', 'poin' => 1],
            ['nama_pelanggaran' => 'Terlambat berbaris', 'poin' => 1],
            ['nama_pelanggaran' => 'Ribut di barisan', 'poin' => 1],
            ['nama_pelanggaran' => 'Tidak memiliki kelengkapan: sendok makan, garpu, botol minum, termos, payung dan pin IT Del', 'poin' => 1],
            ['nama_pelanggaran' => 'Memilih-milih makanan', 'poin' => 1],
            ['nama_pelanggaran' => 'Masuk/keluar ruang makan atau menyimpan ompreng tidak melalui pintu yang telah ditentukan', 'poin' => 1],
            ['nama_pelanggaran' => 'Mengantuk dan tertidur di kelas', 'poin' => 1],
            ['nama_pelanggaran' => 'Mahasiswa tidak belajar kolaboratif malam di ruang kelas yang telah ditentukan atau belajar di saung', 'poin' => 1],
            ['nama_pelanggaran' => 'Tidak menggunakan kaos kakis', 'poin' => 1],
            ['nama_pelanggaran' => 'Menggulung celana bukan karena hujan atau kondisi yang dapat diterima.', 'poin' => 1],
            ['nama_pelanggaran' => 'Menggunakan satu payung untuk dua orang', 'poin' => 1],
            ['nama_pelanggaran' => 'Menggulung celana bukan karena hujan.', 'poin' => 1],
            ['nama_pelanggaran' => 'Tidak melaporkan/membiarkan kerusakan fasilitas kampus.', 'poin' => 1],
            ['nama_pelanggaran' => 'Terlambat mengumpulkan atau memberikan tugas/data yang diperlukan dalam program pembinaan karakter', 'poin' => 1],
            ['nama_pelanggaran' => 'Terlambat (bangun pagi, mengikuti ibadah dan keluar masuk asrama).', 'poin' => 2],
            ['nama_pelanggaran' => 'Meninggalkan lampu kamar tidur atau lampu asrama dalam keadaan menyala', 'poin' => 2],
            ['nama_pelanggaran' => 'Meninggalkan keran air dalam keadaan menyala.', 'poin' => 2],
            ['nama_pelanggaran' => 'Meninggalkan kamar dalam keadaan tidak bersih/rapi', 'poin' => 2],
            ['nama_pelanggaran' => 'Meninggalkan lemari dan tempat tidur dalam keadaan tidak bersih/rapi dan berabu.', 'poin' => 2],
            ['nama_pelanggaran' => 'Menggunakan seprei atau sarung bantal tidak sesuai warna yang seharusnya', 'poin' => 2],
            ['nama_pelanggaran' => 'Melalaikan kerapian serta kebersihan lingkungan asrama: selasar, area kamar mandi, area penyetrikaan, area pantri dan area lainnya di asrama', 'poin' => 2],
            ['nama_pelanggaran' => 'Meninggalkan perlengkapan pribadi di sembarangan tempat: handuk, pakaian, peralatan mandi, ember, dan lainnya', 'poin' => 2],
            ['nama_pelanggaran' => 'Tidak mengambil pakaian kering dari jemuran dalam batas lebih dari 2 x 24 jam (dikondisikan dengan cuaca)', 'poin' => 2],
            ['nama_pelanggaran' => 'Tidak mencuci seprei selama lebih dari 2 minggu', 'poin' => 2],
            ['nama_pelanggaran' => 'Mencuci, mandi di luar wakt yang telah ditentukan.', 'poin' => 2],
            ['nama_pelanggaran' => 'Terlambat masuk asrama pada malam hari', 'poin' => 2],
            ['nama_pelanggaran' => 'Meninggalkan sepatu/sandal/payung bermalam di luar asrama atau pada jam akademik', 'poin' => 2],
            ['nama_pelanggaran' => 'Tidur di kamar mahasiswa lain', 'poin' => 2],
            ['nama_pelanggaran' => 'Tidur berdua dalam satu tempat tidur', 'poin' => 2],
            ['nama_pelanggaran' => 'Tidak mengikuti ibadah pagi tanpa seizin dari pembina asrama', 'poin' => 3],
            ['nama_pelanggaran' => 'Tidak mengikuti senam mahasiswa tanpa seizin dari pembina asrama', 'poin' => 3],
            ['nama_pelanggaran' => 'Tidak melaksanakan tugas piket kebersihan', 'poin' => 3],
            ['nama_pelanggaran' => 'Tidak menggunakan seprei atau sarung bantal', 'poin' => 3],
            ['nama_pelanggaran' => 'Merendam pakaian 1 x 24 jam', 'poin' => 3],
            ['nama_pelanggaran' => 'Tidak mengikuti kegiatan evaluasi dan ibadah malam tanpa seizin pembina asrama', 'poin' => 3],
            ['nama_pelanggaran' => 'Membuat keributan di asrama', 'poin' => 3],
            ['nama_pelanggaran' => 'Membawa dan menyimpan perlengkapan kosmetik yang tidak diperkenankan, seperti: pewarna bibir, pewarna alis, alas bedak, make up, dan lainnya yang tidak sesuai dengan ketentuan perlengkapan mahasiswa', 'poin' => 3],
            ['nama_pelanggaran' => 'Membawa tas beroda/koper/tas bertulang yang tidak bisa dilipat atau dimasukan ke dalam lemari', 'poin' => 3],
            ['nama_pelanggaran' => 'Membawa dan memakan nasi di dalam asrama bukan karena sakit', 'poin' => 3],
            ['nama_pelanggaran' => 'Tidak melaporkan kehilangan barang pribadi yang dialam', 'poin' => 3],
            ['nama_pelanggaran' => 'Tidak mengenakan pakaian atau hanya menggunakan pakaian dalam di asrama', 'poin' => 3],
            ['nama_pelanggaran' => 'Keluar lingkungan asrama dengan menggunakan sandal jepit', 'poin' => 3],
            ['nama_pelanggaran' => 'Membawa benda tajam dan alat pemantik api ke asrama.', 'poin' => 3],
            ['nama_pelanggaran' => 'Masuk/berada di asrama tanpa seizin pembina asrama pada jam akademik atau jam kolaboratif', 'poin' => 3],
            ['nama_pelanggaran' => 'Tidak melaporkan keadaan diri sedang sakit kepada Pembina Asrama', 'poin' => 3],
            ['nama_pelanggaran' => 'Tidak menggunakan seprei/sarung bantal atau tidak menggantinya setelah dipakai dua minggu.', 'poin' => 3],
            ['nama_pelanggaran' => 'Mengabaikan kerapian serta kebersihan lingkungan asrama: selasar, area kamar mandi, area penyetrikaan, area pantri dan area lainnya di asrama; seperti: meletakkan barang dengan tidak rapi di tempat tersebut, meletakkan sampah dengan sembarangan, dsb.', 'poin' => 3],
            ['nama_pelanggaran' => 'Menggunakan pembalut sekali pakai (putri)', 'poin' => 6],
            ['nama_pelanggaran' => 'Mengambil/mencuri makanan mahasiswa lain', 'poin' => 8],
            ['nama_pelanggaran' => '	Menyimpan sampah pribadi dan berbau (seperti: cutton bud, kulit buah, bekas pembalut) di dalam lemari/tas atau barang pribadi lainnya', 'poin' => 10],
            ['nama_pelanggaran' => 'Mencoret, menempel dan memaku benda di dinding asrama', 'poin' => 10],
            ['nama_pelanggaran' => 'Mengambil/mencuri makanan mahasiswa lain', 'poin' => 8],
            ['nama_pelanggaran' => 'Memanjat pagar, tembok dan atau memanjat jendela asrama untuk masuk ke dalam asrama', 'poin' => 15],
            ['nama_pelanggaran' => 'Merusak fasilitas/perlengkapan yang ada di kantin dengan sengaja dan tidak bertanggungjawab', 'poin' => 15],
            ['nama_pelanggaran' => 'Bertindik', 'poin' => 15],
            ['nama_pelanggaran' => 'Mengucapkan atau menuliskan kata-kata yang tidak sopan, kata kasar/kotor atau tidak senonoh baik secara lisan maupun melalui pesan tertulis', 'poin' => 15],
            ['nama_pelanggaran' => 'Membawa alat masak dan memasak di asrama', 'poin' => 15],
            ['nama_pelanggaran' => 'Merusak perlengkapan yang ada di asrama dengan sengaja dan tidak bertanggungjawab', 'poin' => 20],
            ['nama_pelanggaran' => 'Pemalsuan tandatangan absensi kelas', 'poin' => 20],
            ['nama_pelanggaran' => 'Merusak perlengkapan yang ada di kelas dengan sengaja dan tidak bertanggungjawab', 'poin' => 20],
            ['nama_pelanggaran' => 'Bersikap tidak sopan/hormat pada pimpinan, dosen, staff dan karyawan', 'poin' => 20],
            ['nama_pelanggaran' => 'Berdua di tempat gelap dan sepi berpasangan', 'poin' => 20],
            ['nama_pelanggaran' => 'Memalsukan tandatangan pembina asrama', 'poin' => 25],
            ['nama_pelanggaran' => 'Berkelahi dengan teman', 'poin' => 25],
            ['nama_pelanggaran' => '	Menghilangkan atau mengubah bukti pelanggaran, absensi, dll', 'poin' => 25],
            ['nama_pelanggaran' => 'Memberikan keterangan atau informasi yang tidak benar', 'poin' => 25],
            ['nama_pelanggaran' => 'Menyimpan dan membawa kartu remi, domino, uno dan sejenisnya yang dapat dipergunakan untuk kegiatan perjudian', 'poin' => 25],
            ['nama_pelanggaran' => 'kabur dari asrama', 'poin' => 40],
            ['nama_pelanggaran' => 'Mendapat/menyebarkan bocoran soal ujian', 'poin' => 40],
            ['nama_pelanggaran' => 'Menyontek sewaktu ujian', 'poin' => 50],
            ['nama_pelanggaran' => 'Mengambil/menghilangkan barang milik sekolah, guru/teman/tamu', 'poin' => 50],
            ['nama_pelanggaran' => 'Membawa, mengedarkan, menggunakan dan memfasilitasi penggunaan obat-obat terlarang', 'poin' => 100],           
            ['nama_pelanggaran' => 'Memalsukan tandatangan pembina asrama', 'poin' => 25],
            ['nama_pelanggaran' => 'Berkelahi dengan teman', 'poin' => 25],
            ['nama_pelanggaran' => 'Menyimpan dan membawa kartu remi, domino, uno dan sejenisnya yang dapat dipergunakan untuk kegiatan perjudian', 'poin' => 25],
            ['nama_pelanggaran' => 'Mengepos status di media sosial terkait berita yang tidak dapat dipertanggungjawabkan.', 'poin' => 25],
            ['nama_pelanggaran' => 'Memberikan keterangan yang tidak benar tentang kampus IT Del kepada keluarga/orangtua dan sebaliknya meminta keluarga/orangtua memberikan informasi yang tidak benar ke kampus IT Del', 'poin' => 30],
            ['nama_pelanggaran' => 'Tidak membayar bursar tanpa keterangan.', 'poin' => 30],
            ['nama_pelanggaran' => 'kabur dari asrama', 'poin' => 40],
            ['nama_pelanggaran' => 'Mendapat/menyebarkan bocoran soal ujian', 'poin' => 50],
            ['nama_pelanggaran' => 'Menyontek sewaktu ujian', 'poin' => 50],
            ['nama_pelanggaran' => 'Mengambil/menghilangkan barang milik sekolah, guru/teman/tamu', 'poin' => 50],
            ['nama_pelanggaran' => 'Berkelahi dengan peserta didik di kampus lain', 'poin' => 50],
            ['nama_pelanggaran' => 'Melindungi pelaku perkelahian, perjudian dan tindak kriminal lain', 'poin' => 50],
            ['nama_pelanggaran' => 'Masuk ke toilet yang berlawanan jenis', 'poin' => 50],
            ['nama_pelanggaran' => 'Bermesraan dengan teman lain jenis di lingkungan kampus', 'poin' => 50],
            ['nama_pelanggaran' => 'Bermesraan dengan teman sejenis yang mengarah pada penyimpangan perilaku seksual', 'poin' => 50],
            ['nama_pelanggaran' => 'Melakukan provokasi', 'poin' => 50],
            ['nama_pelanggaran' => 'Mengancam pimpinan, dosen, staff dan karyawan	', 'poin' => 50],
            ['nama_pelanggaran' => 'Mengintimidasi sesama peserta didik (mengompas, memalak, bullying/risak)', 'poin' => 50],
            ['nama_pelanggaran' => 'Menyimpan atau menonton atau membagikan di media sosial berupa video atau gambar yang mengarah kepada pornografi', 'poin' => 50],
            ['nama_pelanggaran' => 'Melakukan tindakan penyuapan', 'poin' => 50],
            ['nama_pelanggaran' => 'Dengan sengaja melukai diri sendiri/percobaan bunuh diri', 'poin' => 50],
            ['nama_pelanggaran' => 'Melakukan kecurangan akademik selama masa PJJ termasuk pada saat asesmen, seperti: pengerjaan tugas, kuis, UTS ataupun UAS.', 'poin' => 50],
            ['nama_pelanggaran' => 'Bertato/rajah', 'poin' => 70],
            ['nama_pelanggaran' => 'Melakukan pelecehan seksual', 'poin' => 75],
            ['nama_pelanggaran' => 'Menyimpan senjata tajam/senjata api', 'poin' => 75],
            ['nama_pelanggaran' => 'Mencemarkan nama baik kampus dan Yayasan Del', 'poin' => 75],
            ['nama_pelanggaran' => 'Membawa dan menghisap rokok', 'poin' => 75],
            ['nama_pelanggaran' => 'Memperjualbelikan/mengedarkan rokok', 'poin' => 75],
            ['nama_pelanggaran' => 'Melakukan, mengajak dan memfasilitasi kegiatan perjudian', 'poin' => 75],
            ['nama_pelanggaran' => 'Membawa, meminum dan mengajak meminum minuman keras', 'poin' => 75],
            ['nama_pelanggaran' => 'Melakukan hubungan seksual atau mahasiswi hamil', 'poin' => 100],
            ['nama_pelanggaran' => 'Menganiaya teman, pimpinan IT Del, dosen, staff dan karyawan', 'poin' => 100],
            ['nama_pelanggaran' => 'Melakukan tindakan pidana', 'poin' => 100],
            ['nama_pelanggaran' => 'Membawa, mengedarkan, menggunakan dan memfasilitasi penggunaan obat-obat terlarang', 'poin' => 100],
        ];

        foreach ($pelanggaran as $item) {
            // Tentukan tingkat berdasarkan poin
            $tingkat = $this->getTingkat($item['poin']);

            DB::table('list_pelanggaran')->insert([
                'nama_pelanggaran' => $item['nama_pelanggaran'],
                'poin' => $item['poin'],
                'tingkat' => $tingkat,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Menentukan tingkat berdasarkan poin
     *
     * @param int $poin
     * @return string
     */
    private function getTingkat($poin)
    {
        if ($poin >= 1 && $poin <= 5) {
            return 'Ringan Level 1';
        } elseif ($poin >= 6 && $poin <= 10) {
            return 'Ringan Level 2';
        } elseif ($poin >= 11 && $poin <= 15) {
            return 'Sedang Level 1';
        } elseif ($poin >= 16 && $poin <= 24) {
            return 'Sedang Level 2';
        } elseif ($poin >= 25 && $poin <= 30) {
            return 'Berat Level 1';
        } elseif ($poin >= 31 && $poin <= 75) {
            return 'Berat Level 2';
        } else {
            return 'Berat Level 3';
        }
    }
}
