<?php

namespace App\Services;

class GaleriService
{
    /**
     * Get photo gallery items.
     *
     * @return array<int, array<string, string>>
     */
    public function getFotoList(): array
    {
        return [
            [
                'id' => '1',
                'title' => 'Kegiatan Penataan Arsip Dinamis',
                'category' => 'Kearsipan',
                'image' => 'asset/Card Background Image.png',
                'alt' => 'Dokumentasi Penataan Arsip',
            ],
            [
                'id' => '2',
                'title' => 'Layanan Kunjungan Edukasi Pustaka',
                'category' => 'Perpustakaan',
                'image' => 'asset/bakgron.jpg',
                'alt' => 'Dokumentasi Edukasi Pustaka',
            ],
            [
                'id' => '3',
                'title' => 'Sosialisasi Tata Naskah Kearsipan Digital',
                'category' => 'Workshop',
                'image' => 'asset/arpus.jpg',
                'alt' => 'Dokumentasi Sosialisasi Naskah',
            ],
            [
                'id' => '4',
                'title' => 'Pameran Memori Kolektif Bangsa',
                'category' => 'Pameran',
                'image' => 'asset/semarang.jpg',
                'alt' => 'Dokumentasi Pameran Sejarah',
            ],
            [
                'id' => '5',
                'title' => 'Ruang Baca Nyaman Anak & Remaja',
                'category' => 'Fasilitas',
                'image' => 'asset/Card Background Image.png',
                'alt' => 'Dokumentasi Ruang Baca',
            ],
            [
                'id' => '6',
                'title' => 'Gedung Depo Arsip Kota Semarang',
                'category' => 'Infrastruktur',
                'image' => 'asset/bakgron.jpg',
                'alt' => 'Dokumentasi Gedung Depo Arsip',
            ],
        ];
    }

    /**
     * Get video gallery items.
     *
     * @return array<int, array<string, string>>
     */
    public function getVideoList(): array
    {
        return [
            [
                'id' => '1',
                'title' => 'Profil Singkat Dinas Arsip dan Perpustakaan',
                'youtube_id' => '6rlkqT7Z-GA',
                'embed_url' => 'https://www.youtube.com/embed/6rlkqT7Z-GA',
            ],
            [
                'id' => '2',
                'title' => 'Inovasi Pelayanan Kearsipan Era Digital',
                'youtube_id' => 'aTcjI4nnDnU',
                'embed_url' => 'https://www.youtube.com/embed/aTcjI4nnDnU',
            ],
            [
                'id' => '3',
                'title' => 'Koleksi Langka & Manuskrip Bersejarah Semarang',
                'youtube_id' => 'gL81MXIIdOQ',
                'embed_url' => 'https://www.youtube.com/embed/gL81MXIIdOQ',
            ],
        ];
    }

    /**
     * Get Instagram Reels/Posts items via API.
     *
     * @return array<int, array<string, string>>
     */
    public function getInstagramList(): array
    {
        // 1. Ambil kredensial dari file konfigurasi .env
        $accessToken = env('INSTAGRAM_ACCESS_TOKEN');
        $igUserId = env('INSTAGRAM_USER_ID');

        // 2. Jika token belum diisi oleh pembimbing, gunakan data cadangan
        if (empty($accessToken) || empty($igUserId)) {
            return $this->getDummyInstagramData();
        }

        // 3. Tarik data dari API Meta/Instagram
        try {
            $response = \Illuminate\Support\Facades\Http::timeout(10)->get("https://graph.facebook.com/v18.0/{$igUserId}/media", [
                'fields' => 'media_type,thumbnail_url,media_url,permalink',
                'access_token' => $accessToken,
                'limit' => 4 // Maksimal 4 postingan
            ]);

            if ($response->successful()) {
                $data = $response->json()['data'] ?? [];
                $formattedPosts = [];

                foreach ($data as $post) {
                    $formattedPosts[] = [
                        'media_type'    => $post['media_type'] ?? 'IMAGE',
                        // Jika Reels gunakan thumbnail_url, jika Foto gunakan media_url
                        'thumbnail_url' => ($post['media_type'] ?? '') === 'VIDEO' 
                                            ? ($post['thumbnail_url'] ?? '') 
                                            : ($post['media_url'] ?? ''),
                        'permalink'     => $post['permalink'] ?? '#'
                    ];
                }

                // Pastikan ada isinya sebelum dikembalikan
                if (count($formattedPosts) > 0) {
                    return $formattedPosts;
                }
            }
        } catch (\Exception $e) {
            // Mencatat error ke log sistem Laravel tanpa membuat website crash
            \Illuminate\Support\Facades\Log::error('Instagram API Error: ' . $e->getMessage());
        }

        // 4. Fallback: Jika API gagal merespons, otomatis pakai data cadangan
        return $this->getDummyInstagramData();
    }

    /**
     * Fallback Dummy Data (Data Cadangan)
     *
     * @return array<int, array<string, string>>
     */
    private function getDummyInstagramData(): array
    {
        return [
            [
                'media_type'    => 'VIDEO', 
                'thumbnail_url' => 'asset/arsip1.jpg',
                'permalink'     => 'https://www.instagram.com/reel/DdBhrlDStAP/'
            ],
            [
                'media_type'    => 'VIDEO', 
                'thumbnail_url' => 'asset/buku1.jpg',
                'permalink'     => 'https://www.instagram.com/reel/DdF4YVdPmsl/'
            ],
            [
                'media_type'    => 'VIDEO', 
                'thumbnail_url' => 'asset/tembalang.jpg',
                'permalink'     => 'https://www.instagram.com/reel/DdIts19RPf7/'
            ],
            [
                'media_type'    => 'VIDEO', 
                'thumbnail_url' => 'asset/semarang.jpg',
                'permalink'     => 'https://www.instagram.com/reel/DdLUisNAJ9K/'
            ]
        ];
    }

    /**
     * Get historical archives / pameran documents.
     *
     * @return array<int, array<string, string>>
     */
    public function getArsipList(): array
    {
        return [
            [
                'id' => '1',
                'title' => 'Peta Kolonial Semarang 1900',
                'category' => 'Arsip Peta & Tata Ruang',
                'desc' => 'Arsip peta cetak kuno yang merekam tata wilayah Kota Semarang pada masa Hindia Belanda dengan detail jalur rel dan kawasan pesisir.',
                'image' => 'asset/arsip1.jpg',
            ],
            [
                'id' => '2',
                'title' => 'Naskah Kuno Keputusan Kota Praja',
                'category' => 'Arsip Dokumen Negara',
                'desc' => 'Dokumen lembaran arsip fisik keputusan administratif tempo dulu yang mengatur ketertiban kota dan pasar tradisional.',
                'image' => 'asset/tradisingaliyan.jpg',
            ],
            [
                'id' => '3',
                'title' => 'Gedung Bersejarah Semarang Tempo Doeloe',
                'category' => 'Arsip Foto Historis',
                'desc' => 'Koleksi foto hitam putih pameran fisik bangunan bersejarah di Kawasan Kota Lama Semarang.',
                'image' => 'asset/tembalang.jpg',
            ],
            [
                'id' => '4',
                'title' => 'Surat Kabar Kuno De Locomotief',
                'category' => 'Arsip Media Cetak',
                'desc' => 'Arsip koran bersejarah terbitan Semarang masa lampau yang menjadi saksi bisu dinamika sosial ekonomi Nusantara.',
                'image' => 'asset/kubur.jpg',
            ],
            [
                'id' => '5',
                'title' => 'Manuskrip Sastra & Budaya Pesisiran',
                'category' => 'Naskah Kuno',
                'desc' => 'Pelestarian manuskrip bernilai budaya tinggi yang ditulis tangan pada media kertas tradisional.',
                'image' => 'asset/buku1.jpg',
            ],
            [
                'id' => '6',
                'title' => 'Registrasi Administrasi Kependudukan Lama',
                'category' => 'Dokumen Sipil',
                'desc' => 'Buku register pencatatan kependudukan awal abad ke-20 yang tersimpan rapi di depo arsip statis.',
                'image' => 'asset/heart.jpg',
            ],
        ];
    }
}
