<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Tautan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EditTautan extends Component
{
    use WithFileUploads;

    public $tautanId;
    public $judul = '';
    public $deskripsi = '';
    public $slug = '';
    public $links = [];
    public $logoUrl = '';
    public $footerText1 = '';
    public $footerText2 = '';
    public $generatedHtml = '';
    public $previewHtml = '';

    // QR Color Picker Properties untuk Livewire
    public $qrBackgroundColorPicker = '#ffffff';
    public $qrBorderColorPicker = '#ffffff';
    public $qrDarkColorPicker = '#000000';
    public $qrBackgroundOpacity = 100;
    public $qrBorderOpacity = 100;
    public $qrDarkOpacity = 100;

    // Image upload properties with fixes
    public $logoUpload;
    public $useUploadedLogo = false; // false = URL, true = Upload
    public $logoPreviewUrl = ''; // Fixed: Better preview URL handling
    public $uploadedLogoPath = ''; // Temporary path for cleanup

    // TAMBAHAN: Flag untuk mengontrol input file
    public $hasUploadedImage = false; // Track apakah sudah ada gambar yang diupload

    // Enhanced styling properties with QR code settings
    public $styles = [
        'background' => [
            'gradientStart' => '#002366',
            'gradientEnd' => '#1D4E5F',
            'direction' => '135'
        ],
        'container' => [
            'backgroundType' => 'solid',
            'backgroundColor' => '#FFFFFF',
            'backgroundGradientStart' => '#FFFFFF',
            'backgroundGradientEnd' => '#F8FAFC',
            'backgroundGradientDirection' => '135',
            'borderRadius' => '24',
            'backdropBlur' => '20',
            'topGradientStart' => '#FFD700',
            'topGradientEnd' => '#002366',
            'topGradientHeight' => '4'
        ],
        'title' => [
            'fontSize' => '26',
            'fontWeight' => '700',
            'color' => '#002366'
        ],
        'description' => [
            'color' => '#666666',
            'fontSize' => '15'
        ],
        'button' => [
            'backgroundColor' => '#FFFFFF',
            'color' => '#002366',
            'borderRadius' => '12',
            'borderColor' => '#EAEAEA',
            'borderWidth' => '2',
            'borderStyle' => 'solid'
        ],
        'buttonHover' => [
            'backgroundStart' => '#FFD700',
            'backgroundEnd' => '#FFFFFF',
            'color' => '#002366',
            'glowColor' => '#FFD700',
            'glowBlur' => '30',
            'borderColor' => '#FFD700',
            'borderWidth' => '2',
            'borderStyle' => 'solid'
        ],
        'logo' => [
            'backgroundType' => 'solid',
            'backgroundColor' => '#FFFFFF',
            'backgroundGradientStart' => '#FFFFFF',
            'backgroundGradientEnd' => '#F8FAFC',
            'backgroundGradientDirection' => '135',
            'borderColor' => '#FFD700',
            'borderWidth' => '3',
            'borderStyle' => 'solid',
            'borderRadius' => '50'
        ],
        'footer' => [
            'color' => '#999999',
            'fontSize' => '12',
            'borderColor' => '#EEEEEE',
            'marginTop' => '30',
            'paddingTop' => '20'
        ],
        'qrcode' => [
            'enabled' => true,
            'position' => 'bottom-right',
            'size' => '200',
            'borderRadius' => '12',
            'padding' => '10',
            'showOnMobile' => false,
            'tooltipText' => 'Scan QR untuk buka halaman ini',
            // ✅ 3 KONTROL WARNA TERPISAH - DEFAULT PUTIH-HITAM
            'backgroundColor' => '#ffffff',    // Background QR - PUTIH
            'borderColor' => '#ffffff',        // Border Container - PUTIH
            'darkColor' => '#000000'           // Pattern QR - HITAM
        ]
    ];

    public $stylesJson = '';

    protected $rules = [
        'judul' => 'required|min:3|max:100',
        'slug' => 'required|min:3|max:50|regex:/^[a-zA-Z0-9\-_]+$/',
        'deskripsi' => 'nullable|max:500',
        'logoUrl' => 'nullable|url',
        'logoUpload' => 'nullable|image|max:2048', // max 2MB
        'footerText1' => 'nullable|max:100',
        'footerText2' => 'nullable|max:100',
        'links.*.judul' => 'required|min:1|max:100',
        'links.*.url' => 'required|url',
    ];

    protected $messages = [
        'judul.required' => 'Judul tautan wajib diisi',
        'judul.min' => 'Judul minimal 3 karakter',
        'judul.max' => 'Judul maksimal 100 karakter',
        'slug.required' => 'Slug wajib diisi',
        'slug.min' => 'Slug minimal 3 karakter',
        'slug.max' => 'Slug maksimal 50 karakter',
        'slug.regex' => 'Slug hanya boleh berisi huruf, angka, tanda hubung (-) dan underscore (_)',
        'deskripsi.max' => 'Deskripsi maksimal 500 karakter',
        'logoUrl.url' => 'Format URL logo tidak valid',
        'logoUpload.image' => 'File harus berupa gambar',
        'logoUpload.max' => 'Ukuran gambar maksimal 2MB',
        'footerText1.max' => 'Footer baris 1 maksimal 100 karakter',
        'footerText2.max' => 'Footer baris 2 maksimal 100 karakter',
        'links.*.judul.required' => 'Judul link wajib diisi',
        'links.*.judul.max' => 'Judul link maksimal 100 karakter',
        'links.*.url.required' => 'URL wajib diisi',
        'links.*.url.url' => 'Format URL tidak valid',
    ];

    public function mount($id)
    {
        $this->tautanId = $id;
        $this->loadTautan();
        $this->stylesJson = json_encode($this->styles, JSON_PRETTY_PRINT);

        // ✅ MOVED DEFAULT VALUES INTO loadTautan() - Don't overwrite loaded data

        // ✅ Initialize QR Color Picker values from default styles
        $this->initializeQRColorPickers();

        logger('=== EDIT MOUNT ===');
        logger('Editing tautan ID: ' . $id);
        logger('All flags set to default - free toggle enabled');
        logger('🎨 Initial QR Border Color: ' . $this->styles['qrcode']['borderColor']);
        logger('🎨 Initial QR Dark Color: ' . $this->styles['qrcode']['darkColor']);

        $this->generatePreview();
    }

    /**
     * Load existing tautan data
     */
    private function loadTautan()
    {
        // ✅ Initialize default values BEFORE loading data
        $this->useUploadedLogo = false;    // DEFAULT: URL mode
        $this->hasUploadedImage = false;   // DEFAULT: no uploaded image
        $this->logoPreviewUrl = '';        // DEFAULT: empty
        $this->logoUpload = null;          // DEFAULT: no file

        $tautan = Tautan::where('id', $this->tautanId)
            ->where('user_id', Auth::id())
            ->first();

        if (!$tautan) {
            session()->flash('error', 'Tautan tidak ditemukan atau Anda tidak memiliki akses.');
            return redirect()->route('kelola-tautan');
        }

        // Load existing data
        $this->judul = $tautan->title;
        $this->deskripsi = $tautan->description ?? '';
        $this->slug = $tautan->slug;
        $this->links = $tautan->links ?? [];
        $this->logoUrl = $tautan->logo_url ?? '';
        $this->footerText1 = $tautan->footer_text_1 ?? '';
        $this->footerText2 = $tautan->footer_text_2 ?? '';

        // Load styles if exists
        if ($tautan->styles) {
            $this->styles = array_merge($this->styles, $tautan->styles);
        }

        // Set logo mode from database (will override defaults)
        $this->useUploadedLogo = $tautan->use_uploaded_logo ?? false;

        // PERBAIKAN: Set hasUploadedImage dengan benar untuk mode edit
        if ($this->useUploadedLogo) {
            // Mode upload - cek apakah ada logo yang tersimpan
            $this->hasUploadedImage = !empty($this->logoUrl) || !empty($tautan->logo_url);

            // Jika ada logo di database, set preview URL
            if (!empty($this->logoUrl)) {
                $this->logoPreviewUrl = $this->logoUrl;
            } elseif (!empty($tautan->logo_url)) {
                $this->logoPreviewUrl = $tautan->logo_url;
            }
        } else {
            // Mode URL - cek apakah ada logo URL
            $this->hasUploadedImage = false;
            $this->logoPreviewUrl = '';
        }

        // Add at least one link if empty
        if (empty($this->links)) {
            $this->addLink();
        }

        logger('Loaded tautan: ' . $tautan->title);
        logger('Logo mode: ' . ($this->useUploadedLogo ? 'Upload' : 'URL'));

        // Generate initial preview
        $this->generatePreview();

        logger('✅ Edit tautan loaded successfully');
        logger('📊 Data loaded - Judul: ' . $this->judul);
        logger('📊 Data loaded - Slug: ' . $this->slug);
        logger('📊 Data loaded - Links: ' . count($this->links));
        logger('📊 Data loaded - Preview HTML length: ' . strlen($this->previewHtml ?? ''));
    }

    /**
     * Initialize QR Color Picker values from default styles
     */
    private function initializeQRColorPickers()
    {
        // Get default QR colors from styles
        $qrStyles = $this->styles['qrcode'];

        // Extract hex colors from rgba values (default styles use rgba)
        $bgColor = $qrStyles['backgroundColor'] ?? '#ffffff';
        $borderColor = $qrStyles['borderColor'] ?? '#ffffff';
        $darkColor = $qrStyles['darkColor'] ?? '#000000';

        // Convert to hex if rgba format
        $this->qrBackgroundColorPicker = $this->rgbaToHex($bgColor);
        $this->qrBorderColorPicker = $this->rgbaToHex($borderColor);
        $this->qrDarkColorPicker = $this->rgbaToHex($darkColor);

        // Set default opacity to 100%
        $this->qrBackgroundOpacity = 100;
        $this->qrBorderOpacity = 100;
        $this->qrDarkOpacity = 100;

        logger('🎨 QR Color Pickers initialized:');
        logger('   Background: ' . $this->qrBackgroundColorPicker);
        logger('   Border: ' . $this->qrBorderColorPicker);
        logger('   Dark: ' . $this->qrDarkColorPicker);
    }

    /**
     * Convert rgba to hex for color picker initialization
     */
    private function rgbaToHex($color)
    {
        if (strpos($color, 'rgba') === 0) {
            // Extract RGB from rgba(r, g, b, a)
            preg_match('/rgba\((\d+),\s*(\d+),\s*(\d+)/', $color, $matches);
            if (count($matches) >= 4) {
                $r = intval($matches[1]);
                $g = intval($matches[2]);
                $b = intval($matches[3]);
                return sprintf("#%02x%02x%02x", $r, $g, $b);
            }
        } elseif (strpos($color, 'rgb') === 0) {
            // Extract RGB from rgb(r, g, b)
            preg_match('/rgb\((\d+),\s*(\d+),\s*(\d+)/', $color, $matches);
            if (count($matches) >= 4) {
                $r = intval($matches[1]);
                $g = intval($matches[2]);
                $b = intval($matches[3]);
                return sprintf("#%02x%02x%02x", $r, $g, $b);
            }
        }

        // Return as-is if already hex or other format
        return $color;
    }

    // FIXED: Handle logo upload with multiple fallback methods
    public function updatedLogoUpload()
    {
        $this->validate([
            'logoUpload' => 'image|max:2048',
        ]);

        if ($this->logoUpload) {
            try {
                logger('=== UPLOAD START ===');
                logger('New file uploaded: ' . $this->logoUpload->getClientOriginalName());

                // Reset preview URL untuk file baru
                $this->logoPreviewUrl = '';

                // Try different methods untuk generate preview
                try {
                    $this->logoPreviewUrl = $this->logoUpload->temporaryUrl();
                    logger('Preview generated with temporaryUrl');
                } catch (\Exception $e) {
                    logger('temporaryUrl failed, trying base64');
                    if ($this->logoUpload->getSize() < 500000) {
                        $imageData = base64_encode($this->logoUpload->get());
                        $mimeType = $this->logoUpload->getMimeType();
                        $this->logoPreviewUrl = "data:{$mimeType};base64,{$imageData}";
                        logger('Preview generated with base64');
                    }
                }

                if (!empty($this->logoPreviewUrl)) {
                    // PERBAIKAN: Set flags dengan benar untuk FILE BARU
                    $this->hasUploadedImage = true;
                    $this->useUploadedLogo = true;  // Auto switch ke upload mode

                    // Clear existing logo URL untuk diganti dengan file baru
                    $this->logoUrl = '';

                    $this->generatePreview();
                    session()->flash('success', 'Logo baru berhasil diupload!');
                    logger('New upload successful - flags set correctly');
                } else {
                    throw new \Exception('Gagal generate preview URL');
                }
            } catch (\Exception $e) {
                // Reset flags jika upload gagal
                $this->hasUploadedImage = false;
                session()->flash('error', 'Gagal upload: ' . $e->getMessage());
                logger('Upload failed: ' . $e->getMessage());
            }
        }

        $this->dispatchBrowserEvent('logo-uploaded', [
            'logoPreviewUrl' => $this->logoPreviewUrl ?: '',
            'fileName' => $this->logoUpload ? $this->logoUpload->getClientOriginalName() : ''
        ]);
    }

    public function updatedUseUploadedLogo()
    {
        // PERBAIKAN: HILANGKAN SEMUA BLOCKING LOGIC!
        // Allow toggle bebas tanpa restrict apapun

        logger('=== TOGGLE BEBAS ===');
        logger('useUploadedLogo changed to: ' . ($this->useUploadedLogo ? 'true (Upload)' : 'false (URL)'));
        logger('hasUploadedImage: ' . ($this->hasUploadedImage ? 'true' : 'false'));

        // Generate preview sesuai mode baru - NO BLOCKING
        $this->generatePreview();

        // Kasih pesan informatif aja, tidak ada blocking
        $message = $this->useUploadedLogo
            ? 'Beralih ke mode Upload Gambar'
            : 'Beralih ke mode Link URL';

        session()->flash('success', $message);
        logger('Toggle successful: ' . $message);
    }

    // PERBAIKAN: Get current logo source with better handling
    public function getCurrentLogoSource()
    {
        // Log untuk debugging
        logger('getCurrentLogoSource - useUploadedLogo: ' . ($this->useUploadedLogo ? 'true' : 'false'));
        logger('getCurrentLogoSource - logoPreviewUrl: ' . ($this->logoPreviewUrl ?: 'empty'));
        logger('getCurrentLogoSource - logoUrl: ' . ($this->logoUrl ?: 'empty'));

        if ($this->useUploadedLogo && !empty($this->logoPreviewUrl)) {
            // Validate URL before returning
            if (filter_var($this->logoPreviewUrl, FILTER_VALIDATE_URL) || strpos($this->logoPreviewUrl, 'data:') === 0) {
                return $this->logoPreviewUrl;
            } else {
                logger('Invalid logoPreviewUrl, falling back to logoUrl');
            }
        }

        return $this->logoUrl ?: 'https://i.pinimg.com/474x/e4/8a/b2/e48ab2e2e8055f15f04caf6968c1314a.jpg';
    }

    // PERBAIKAN: Clear uploaded logo and reset ke URL mode
    public function clearUploadedLogo()
    {
        logger('=== CLEAR UPLOAD ===');

        // Clean up files
        if (!empty($this->uploadedLogoPath) && Storage::disk('public')->exists($this->uploadedLogoPath)) {
            Storage::disk('public')->delete($this->uploadedLogoPath);
        }

        // Reset semua properties
        $this->logoUpload = null;
        $this->logoPreviewUrl = '';
        $this->uploadedLogoPath = '';
        $this->hasUploadedImage = false;
        $this->useUploadedLogo = false;  // Auto kembali ke URL

        $this->generatePreview();
        session()->flash('success', 'Gambar dihapus. Kembali ke mode URL.');
        logger('Upload cleared - all flags reset');
    }

    public function clearForm()
    {
        // Reload original data instead of clearing
        $this->loadTautan();
        $this->generatePreview();
        session()->flash('success', 'Form berhasil direset ke data asli!');
    }

    public function clearStyles()
    {
        $this->resetStylesToDefault();
        $this->generatePreview();
        session()->flash('success', 'Styles berhasil direset ke default!');
    }

    private function resetStylesToDefault()
    {
        $this->styles = [
            'background' => [
                'gradientStart' => '#002366',
                'gradientEnd' => '#1D4E5F',
                'direction' => '135'
            ],
            'container' => [
                'backgroundType' => 'solid',
                'backgroundColor' => '#FFFFFF',
                'backgroundGradientStart' => '#FFFFFF',
                'backgroundGradientEnd' => '#F8FAFC',
                'backgroundGradientDirection' => '135',
                'borderRadius' => '24',
                'backdropBlur' => '20',
                'topGradientStart' => '#FFD700',
                'topGradientEnd' => '#002366',
                'topGradientHeight' => '4'
            ],
            'title' => [
                'fontSize' => '26',
                'fontWeight' => '700',
                'color' => '#002366'
            ],
            'description' => [
                'color' => '#666666',
                'fontSize' => '15'
            ],
            'button' => [
                'backgroundColor' => '#FFFFFF',
                'color' => '#002366',
                'borderRadius' => '12',
                'borderColor' => '#EAEAEA',
                'borderWidth' => '2',
                'borderStyle' => 'solid'
            ],
            'buttonHover' => [
                'backgroundStart' => '#FFD700',
                'backgroundEnd' => '#FFFFFF',
                'color' => '#002366',
                'glowColor' => '#FFD700',
                'glowBlur' => '30',
                'borderColor' => '#FFD700',
                'borderWidth' => '2',
                'borderStyle' => 'solid'
            ],
            'logo' => [
                'backgroundType' => 'solid',
                'backgroundColor' => '#FFFFFF',
                'backgroundGradientStart' => '#FFFFFF',
                'backgroundGradientEnd' => '#F8FAFC',
                'backgroundGradientDirection' => '135',
                'borderColor' => '#FFD700',
                'borderWidth' => '3',
                'borderStyle' => 'solid',
                'borderRadius' => '50'
            ],
            'footer' => [
                'color' => '#999999',
                'fontSize' => '12',
                'borderColor' => '#EEEEEE',
                'marginTop' => '30',
                'paddingTop' => '20'
            ],
            'qrcode' => [
                'enabled' => true,
                'position' => 'bottom-right',
                'size' => '200',
                'borderRadius' => '12',
                'padding' => '10',
                'showOnMobile' => false,
                'tooltipText' => 'Scan QR untuk buka halaman ini',
                // ✅ 3 KONTROL WARNA TERPISAH - DEFAULT PUTIH-HITAM
                'backgroundColor' => '#ffffff',    // Background QR - PUTIH
                'borderColor' => '#ffffff',        // Border Container - PUTIH
                'darkColor' => '#000000'           // Pattern QR - HITAM
            ]
        ];

        $this->stylesJson = json_encode($this->styles, JSON_PRETTY_PRINT);
    }

    public function loadSampleData()
    {
        $this->initializeDefaultData();
        $this->generatePreview();
        session()->flash('success', 'Data contoh berhasil dimuat!');
    }

    /**
     * Initialize default data for sample
     */
    private function initializeDefaultData()
    {
        $this->judul = 'Tautan Contoh';
        $this->deskripsi = 'Ini adalah contoh deskripsi untuk tautan';
        $this->slug = 'tautan-contoh';

        $this->links = [
            [
                'judul' => 'Website BPS',
                'url' => 'https://tanjungpinangkota.bps.go.id',
                'backgroundColor' => '#FFFFFF',
                'textColor' => '#002366'
            ],
            [
                'judul' => 'Data Sosial',
                'url' => 'https://tanjungpinangkota.bps.go.id/subject/data-sosial',
                'backgroundColor' => '#F0F9FF',
                'textColor' => '#1E40AF'
            ]
        ];

        $this->logoUrl = 'https://i.pinimg.com/474x/e4/8a/b2/e48ab2e2e8055f15f04caf6968c1314a.jpg';
        $this->footerText1 = 'BPS Kota Tanjungpinang';
        $this->footerText2 = 'Jl. Soekarno Hatta No. 1, Tanjungpinang';

        logger('✅ Default data initialized');
    }

    // Updated methods...
    public function updatedJudul()
    {
        try {
            if (empty($this->slug) || $this->slug === $this->generateSlugFromTitle($this->judul)) {
                $this->slug = $this->generateSlugFromTitle($this->judul);
            }
            $this->generatePreview();
        } catch (\Exception $e) {
            logger('Error updating judul: ' . $e->getMessage());
        }
    }

    // BARU: Method untuk generate slug dari title tanpa menghapus trailing chars
    private function generateSlugFromTitle($title)
    {
        if (empty($title)) {
            return '';
        }

        // Convert ke slug tapi pertahankan struktur user
        return Str::slug($title);
    }

    public function updatedSlug()
    {
        try {
            // PERBAIKAN: Jangan langsung hapus trailing characters
            $this->slug = $this->cleanSlugGently($this->slug);
            $this->generatePreview();
        } catch (\Exception $e) {
            logger('Error updating slug: ' . $e->getMessage());
        }
    }

    // BARU: Method untuk clean slug dengan lembut
    private function cleanSlugGently($slug)
    {
        if (empty($slug)) {
            return '';
        }

        // Cek apakah user sedang mengetik (ending dengan - atau _)
        $isTyping = str_ends_with($slug, '-') || str_ends_with($slug, '_');

        if ($isTyping) {
            // Jika sedang mengetik, hanya bersihkan karakter invalid tapi pertahankan trailing
            $cleaned = preg_replace('/[^a-zA-Z0-9\-_]/', '', $slug);
            // Hapus multiple dashes/underscores berturut-turut tapi pertahankan yang terakhir
            $cleaned = preg_replace('/[-_]{2,}/', '-', $cleaned);
            return strtolower($cleaned);
        } else {
            // Jika tidak sedang mengetik, bersihkan normal
            return Str::slug($slug);
        }
    }

    // BARU: Method untuk validasi final slug (dipanggil saat submit)
    private function getFinalSlug()
    {
        return rtrim(Str::slug($this->slug), '-_');
    }

    public function updatedDeskripsi()
    {
        $this->generatePreview();
    }

    public function updatedLogoUrl()
    {
        $this->generatePreview();
    }

    public function updatedFooterText1()
    {
        $this->generatePreview();
    }

    public function updatedFooterText2()
    {
        $this->generatePreview();
    }

    public function updatedLinks()
    {
        $this->generatePreview();
    }

    // Di method updatedStyles()
    public function updatedStyles()
    {
        try {
            // Debug: Log QR color changes
            if (isset($this->styles['qrcode']['borderColor'])) {
                logger('🎨 QR Border Color updated: ' . $this->styles['qrcode']['borderColor']);
            }
            if (isset($this->styles['qrcode']['darkColor'])) {
                logger('🎨 QR Dark Color updated: ' . $this->styles['qrcode']['darkColor']);
            }

            $this->stylesJson = json_encode($this->styles, JSON_PRETTY_PRINT);
            $this->generatePreview();
        } catch (\Exception $e) {
            logger('Error updating styles: ' . $e->getMessage());
        }
    }

    public function applyJsonStyles()
    {
        try {
            $decodedStyles = json_decode($this->stylesJson, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                session()->flash('error', 'Invalid JSON format: ' . json_last_error_msg());
                return;
            }

            if (!is_array($decodedStyles)) {
                session()->flash('error', 'JSON must be a valid object.');
                return;
            }

            $this->styles = $this->deepMergeArrays($this->styles, $decodedStyles);
            $this->stylesJson = json_encode($this->styles, JSON_PRETTY_PRINT);
            $this->generatePreview();

            $this->emit('stylesUpdated');  // Sudah benar

            session()->flash('success', 'JSON styles berhasil diterapkan!');
        } catch (\Exception $e) {
            session()->flash('error', 'Error applying JSON: ' . $e->getMessage());
        }
    }

    private function deepMergeArrays($array1, $array2)
    {
        foreach ($array2 as $key => $value) {
            if (is_array($value) && isset($array1[$key]) && is_array($array1[$key])) {
                $array1[$key] = $this->deepMergeArrays($array1[$key], $value);
            } else {
                $array1[$key] = $value;
            }
        }
        return $array1;
    }

    public function updatedStylesJson()
    {
        try {
            $decodedStyles = json_decode($this->stylesJson, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decodedStyles)) {
                $this->styles = $this->deepMergeArrays($this->styles, $decodedStyles);
                $this->generatePreview();
                $this->emit('stylesUpdated');
            }
        } catch (\Exception $e) {
            // Invalid JSON, keep current styles
        }
    }

    /**
     * Special method to handle QR color updates from Livewire
     */
    public function updatedStylesQrcodeBorderColor()
    {
        logger('🎨 QR Border Color updated via Livewire: ' . $this->styles['qrcode']['borderColor']);
        $this->generatePreview();
    }

    /**
     * Special method to handle QR dark color updates from Livewire
     */
    public function updatedStylesQrcodeDarkColor()
    {
        logger('🎨 QR Dark Color updated via Livewire: ' . $this->styles['qrcode']['darkColor']);
        $this->generatePreview();
    }

    // ✅ QR COLOR PICKER LIVEWIRE UPDATE METHODS
    public function updatedQrBackgroundColorPicker()
    {
        logger('🎨 QR Background Color Picker updated: ' . $this->qrBackgroundColorPicker);
        $this->updateQRColorsFromPickers();
    }

    public function updatedQrBackgroundOpacity()
    {
        logger('🎨 QR Background Opacity updated: ' . $this->qrBackgroundOpacity);
        $this->updateQRColorsFromPickers();
    }

    public function updatedQrBorderColorPicker()
    {
        logger('🎨 QR Border Color Picker updated: ' . $this->qrBorderColorPicker);
        $this->updateQRColorsFromPickers();
    }

    public function updatedQrBorderOpacity()
    {
        logger('🎨 QR Border Opacity updated: ' . $this->qrBorderOpacity);
        $this->updateQRColorsFromPickers();
    }

    public function updatedQrDarkColorPicker()
    {
        logger('🎨 QR Dark Color Picker updated: ' . $this->qrDarkColorPicker);
        $this->updateQRColorsFromPickers();
    }

    public function updatedQrDarkOpacity()
    {
        logger('🎨 QR Dark Opacity updated: ' . $this->qrDarkOpacity);
        $this->updateQRColorsFromPickers();
    }

    /**
     * Update QR colors from pickers with opacity
     */
    private function updateQRColorsFromPickers()
    {
        // Convert colors with opacity
        $bgOpacity = $this->qrBackgroundOpacity / 100;
        $borderOpacity = $this->qrBorderOpacity / 100;
        $darkOpacity = $this->qrDarkOpacity / 100;

        // Update styles dengan RGBA colors
        $this->styles['qrcode']['backgroundColor'] = $this->hexToRgba($this->qrBackgroundColorPicker, $bgOpacity);
        $this->styles['qrcode']['borderColor'] = $this->hexToRgba($this->qrBorderColorPicker, $borderOpacity);
        $this->styles['qrcode']['darkColor'] = $this->hexToRgba($this->qrDarkColorPicker, $darkOpacity);

        // Log untuk debugging
        logger('✅ QR Colors updated via Livewire:');
        logger('   Background: ' . $this->styles['qrcode']['backgroundColor']);
        logger('   Border: ' . $this->styles['qrcode']['borderColor']);
        logger('   Dark: ' . $this->styles['qrcode']['darkColor']);

        // Generate preview
        $this->generatePreview();
    }

    public function addLink()
    {
        $this->links[] = [
            'judul' => '',
            'url' => '',
            // PERBAIKAN: Toggle system untuk per-link styling
            'enableCustomStyling' => false, // DEFAULT: DISABLED - gunakan global style
            'backgroundColor' => '#FFFFFF', // Default white background (hanya digunakan jika enableCustomStyling = true)
            'textColor' => '#002366'          // Default blue text (hanya digunakan jika enableCustomStyling = true)
        ];
    }

    public function removeLink($index)
    {
        if (count($this->links) > 1) {
            unset($this->links[$index]);
            $this->links = array_values($this->links);
            $this->generatePreview();
        }
    }

    public function generatePreview()
    {
        try {
            logger('=== EDIT GENERATING PREVIEW ===');
            logger('Judul: ' . $this->judul);
            logger('Deskripsi: ' . $this->deskripsi);
            logger('Slug: ' . $this->slug);
            logger('Links count: ' . count($this->links));

            $this->previewHtml = $this->buildHtml(true);
            logger('Preview generated successfully, length: ' . strlen($this->previewHtml));
        } catch (\Exception $e) {
            logger('Error generating preview: ' . $e->getMessage());
            logger('Stack trace: ' . $e->getTraceAsString());
            $this->previewHtml = $this->buildPlaceholderHtml();
        }
    }

    public function updatePreview()
    {
        $this->generatePreview();
    }

    public function setQRColor($darkColor)
    {
        $this->styles['qrcode']['darkColor'] = $darkColor;
        $borderColor = $this->styles['qrcode']['borderColor'];
        // Background QR otomatis sama dengan border color
        $this->styles['qrcode']['backgroundColor'] = $borderColor;
        $this->styles['qrcode']['lightColor'] = $borderColor;
        $this->updatePreview();
    }

    public function generateFinalHtml()
    {
        // Gunakan final slug untuk validasi
        $originalSlug = $this->slug;
        $this->slug = $this->getFinalSlug();

        $this->validate();

        $validLinks = $this->getValidLinks();

        if (empty($validLinks)) {
            session()->flash('error', 'Minimal harus ada satu link yang valid.');
            return;
        }

        try {
            $this->generatedHtml = $this->buildHtml(false);
            $this->emit('htmlGenerated');
            session()->flash('success', 'HTML berhasil digenerate!');
        } catch (\Exception $e) {
            $this->emit('htmlError', $e->getMessage());
            session()->flash('error', 'Error generating HTML: ' . $e->getMessage());
        } finally {
            // Restore slug untuk UI
            $this->slug = $originalSlug;
        }
    }

    // UPDATE: Method saveToDatabase() untuk menggunakan final slug
    public function updateToDatabase()
    {
        $originalSlug = $this->slug;
        $this->slug = $this->getFinalSlug();

        $this->validate();

        if (!$this->validateSlug()) {
            $this->slug = $originalSlug;
            session()->flash('error', 'Slug tidak valid atau sudah di-reserve sistem.');
            return;
        }

        $validLinks = $this->getValidLinks();

        if (empty($validLinks)) {
            $this->emit('databaseError', 'Minimal harus ada satu link yang valid.');
            session()->flash('error', 'Minimal harus ada satu link yang valid.');
            $this->slug = $originalSlug;
            return;
        }

        // Check if slug is used by another tautan (excluding current)
        $existingTautan = Tautan::where('slug', $this->slug)
            ->where('user_id', Auth::id())
            ->where('id', '!=', $this->tautanId)
            ->first();

        if ($existingTautan) {
            $this->emit('databaseError', 'Slug "' . $this->slug . '" sudah digunakan oleh tautan lain.');
            session()->flash('error', 'Slug sudah digunakan oleh tautan lain. Gunakan slug yang berbeda.');
            $this->slug = $originalSlug;
            return;
        }

        // Get current tautan
        $tautan = Tautan::where('id', $this->tautanId)
            ->where('user_id', Auth::id())
            ->first();

        if (!$tautan) {
            session()->flash('error', 'Tautan tidak ditemukan.');
            return;
        }

        try {
            // ✅ HANDLE LOGO UPLOAD - LIVEWIRE CORRECT WAY
            $logoPath = $this->logoUrl; // Default ke URL eksternal
            $judulGambar = null;

            if ($this->useUploadedLogo && $this->logoUpload) {
                try {
                    logger('🔍 === UPLOAD START ===');
                    logger('File name: ' . $this->logoUpload->getClientOriginalName());
                    logger('File size: ' . $this->logoUpload->getSize() . ' bytes');
                    logger('File mime: ' . $this->logoUpload->getMimeType());

                    // Validate file
                    $this->validate([
                        'logoUpload' => 'required|image|mimes:jpeg,jpg,png,gif,webp|max:2048'
                    ]);

                    // Generate filename
                    $extension = $this->logoUpload->getClientOriginalExtension();
                    $filename = $this->slug . '-logo.' . $extension;

                    logger('📝 Target filename: ' . $filename);
                    logger('📍 Target disk: public');
                    logger('📂 Target path: logos/' . $filename);

                    // ✅ CARA LIVEWIRE YANG BENAR - storeAs
                    $storedPath = $this->logoUpload->storeAs(
                        'logos',           // folder dalam public/storage/
                        $filename,         // nama file
                        'public'           // disk yang digunakan
                    );

                    logger('✅ storeAs() returned: ' . $storedPath);

                    // Verify file exists di filesystem
                    $fullPath = storage_path('app/public/' . $storedPath);
                    logger('🔍 Checking file at: ' . $fullPath);

                    if (file_exists($fullPath)) {
                        logger('✅ File exists! Size: ' . filesize($fullPath) . ' bytes');

                        // Path untuk database (URL accessible)
                        $logoPath = Storage::url($storedPath);
                        $judulGambar = $filename;

                        logger('✅ Final logo_url for DB: ' . $logoPath);
                        logger('✅ Storage::url() result: ' . $logoPath);
                    } else {
                        throw new \Exception('File tidak ditemukan di: ' . $fullPath);
                    }
                } catch (\Illuminate\Validation\ValidationException $e) {
                    logger('❌ Validation error: ' . json_encode($e->errors()));
                    session()->flash('error', 'Validasi gagal: ' . implode(', ', $e->validator->errors()->all()));
                    $this->slug = $originalSlug;
                    return;
                } catch (\Exception $uploadError) {
                    logger('❌ Upload error: ' . $uploadError->getMessage());
                    logger('❌ Stack trace: ' . $uploadError->getTraceAsString());
                    session()->flash('error', 'Gagal upload gambar: ' . $uploadError->getMessage());
                    $this->slug = $originalSlug;
                    return;
                }
            }

            logger('💾 Updating tautan with logo_url: ' . $logoPath);

            // Debug: Log QR colors being saved
            logger('🎨 QR Border Color being saved: ' . ($this->styles['qrcode']['borderColor'] ?? 'NOT SET'));
            logger('🎨 QR Dark Color being saved: ' . ($this->styles['qrcode']['darkColor'] ?? 'NOT SET'));
            logger('🎨 Full QR Styles being saved: ' . json_encode($this->styles['qrcode'] ?? []));

            // ✅ UPDATE DATA DI DATABASE
            $tautan->update([
                'title' => $this->judul,
                'description' => $this->deskripsi,
                'slug' => $this->slug,
                'links' => array_values($validLinks),
                'styles' => $this->styles,
                'logo_url' => $logoPath,
                'judul_gambar' => $judulGambar,
                'use_uploaded_logo' => $this->useUploadedLogo,
                'tujuan' => 'internal',
                'footer_text_1' => $this->footerText1,
                'footer_text_2' => $this->footerText2,
                'is_active' => true,
            ]);

            // ✅ GENERATE PUBLIC URL
            $publicUrl = route('tautan.show', $tautan->slug);

            $this->emit('databaseSaved');
            session()->flash('success', 'Tautan berhasil diperbarui!');
            session()->flash('public_url', $publicUrl);

            logger('✅ Tautan updated successfully: ' . $publicUrl);
            logger('📸 Logo URL: ' . $logoPath);
        } catch (\Exception $e) {
            $this->emit('databaseError', $e->getMessage());
            session()->flash('error', 'Gagal menyimpan: ' . $e->getMessage());
            logger('❌ Error updating tautan: ' . $e->getMessage());
        } finally {
            $this->slug = $originalSlug;
        }
    }

    private function getValidLinks()
    {
        return array_filter($this->links, function ($link) {
            return !empty($link['judul']) && !empty($link['url']);
        });
    }

    private function buildHtml($isPreview = false)
    {
        logger('=== BUILD HTML DEBUG ===');
        logger('isPreview: ' . ($isPreview ? 'true' : 'false'));
        logger('Judul: "' . $this->judul . '"');
        logger('Deskripsi: "' . $this->deskripsi . '"');
        logger('Links: ' . json_encode($this->links));
        logger('useUploadedLogo: ' . ($this->useUploadedLogo ? 'true' : 'false'));
        logger('logoUrl: "' . $this->logoUrl . '"');
        logger('logoPreviewUrl: "' . $this->logoPreviewUrl . '"');
        logger('hasUploadedImage: ' . ($this->hasUploadedImage ? 'true' : 'false'));

        $validLinks = $this->getValidLinks();
        logger('Valid links count: ' . count($validLinks));
        logger('Valid links: ' . json_encode($validLinks));

        if ($isPreview && (empty($this->judul) || empty($validLinks))) {
            logger('🚫 Returning placeholder HTML - empty judul or no valid links');
            return $this->buildPlaceholderHtml();
        }

        $safeTitle = htmlspecialchars($this->judul ?: 'Judul Tautan', ENT_QUOTES, 'UTF-8');
        $safeDesc = htmlspecialchars($this->deskripsi ?: '', ENT_QUOTES, 'UTF-8');

        // Updated logo handling
        $safeLogo = $this->getCurrentLogoSource();
        $safeLogo = htmlspecialchars($safeLogo, ENT_QUOTES, 'UTF-8');

        $safeSlug = htmlspecialchars($this->slug ?: 'tautan', ENT_QUOTES, 'UTF-8');
        $safeFooter1 = htmlspecialchars($this->footerText1 ?: '', ENT_QUOTES, 'UTF-8');
        $safeFooter2 = htmlspecialchars($this->footerText2 ?: '', ENT_QUOTES, 'UTF-8');

        $css = $this->buildOptimizedCSS();

        $linkItems = '';
        foreach ($validLinks as $link) {
            $linkUrl = htmlspecialchars($link['url'], ENT_QUOTES, 'UTF-8');
            $linkJudul = htmlspecialchars($link['judul'], ENT_QUOTES, 'UTF-8');

            // PERBAIKAN: Gunakan toggle system untuk per-link styling
            if ($link['enableCustomStyling'] ?? false) {
                // Custom styling ENABLED - gunakan warna dari link ini
                $linkBgColor = htmlspecialchars($link['backgroundColor'] ?? $this->styles['button']['backgroundColor'], ENT_QUOTES, 'UTF-8');
                $linkTextColor = htmlspecialchars($link['textColor'] ?? $this->styles['button']['color'], ENT_QUOTES, 'UTF-8');
                // Build link dengan inline styles dari link ini
                $linkItems .= "            <a href=\"{$linkUrl}\" class=\"link-button\" style=\"background: {$linkBgColor}; color: {$linkTextColor};\" target=\"_blank\" rel=\"noopener noreferrer\">{$linkJudul}</a>\n";
            } else {
                // Custom styling DISABLED - gunakan global style dari styles['button']
                $linkBgColor = htmlspecialchars($this->styles['button']['backgroundColor'], ENT_QUOTES, 'UTF-8');
                $linkTextColor = htmlspecialchars($this->styles['button']['color'], ENT_QUOTES, 'UTF-8');
                // Build link dengan inline styles dari global button style
                $linkItems .= "            <a href=\"{$linkUrl}\" class=\"link-button\" style=\"background: {$linkBgColor}; color: {$linkTextColor};\" target=\"_blank\" rel=\"noopener noreferrer\">{$linkJudul}</a>\n";
            }
        }

        $footerContent = $this->buildFooterContent($safeFooter1, $safeFooter2);

        // KEMBALI KE FORMAT COMMENT SEDERHANA - SESUAI GITHUB PAGE CREATOR
        $imageIndicator = $this->useUploadedLogo ? 'true' : 'false';
        $filenameComment = $isPreview ? '' : "<!-- filename: {$safeSlug} -->\n<!-- image: {$imageIndicator} -->\n";

        return $this->buildCompleteHtml($filenameComment, $safeTitle, $safeDesc, $css, $safeLogo, $linkItems, $footerContent);
    }

    private function buildFooterContent($footer1, $footer2)
    {
        if (empty($footer1) && empty($footer2)) {
            return '';
        }

        $footerContent = "<div class=\"footer\">\n";
        if (!empty($footer1)) {
            $footerContent .= "            <p>{$footer1}</p>\n";
        }
        if (!empty($footer2)) {
            $footerContent .= "            <p>{$footer2}</p>\n";
        }
        $footerContent .= "        </div>";

        return $footerContent;
    }

    /**
     * Build HTML comment section
     */
    private function buildHtmlComment()
    {
        $timestamp = now()->format('Y-m-d H:i:s');
        $filename = $this->slug . '.html';
        $useUpload = $this->useUploadedLogo ? 'true' : 'false';
        $logoSource = $this->useUploadedLogo ? 'Upload Gambar' : 'URL Link';
        $tujuan = 'internal'; // Untuk edit form

        // Tentukan instruksi untuk gambar
        $imageInstructions = '';
        if ($this->useUploadedLogo && $this->logoUpload) {
            $imageInstructions = "// UPLOAD: Copy gambar ke /images/{$filename}\n";
            $imageInstructions .= "// CMD: cp logo-{$filename} /path/to/gh-pages/images/{$filename}\n";
        } elseif (!empty($this->logoUrl)) {
            $imageInstructions = "// URL: Gambar akan diambil dari URL eksternal\n";
        } else {
            $imageInstructions = "// DEFAULT: Menggunakan gambar default\n";
        }

        $logoPreview = $this->getCurrentLogoSource();

        $htmlComment = "<!-- \n";
        $htmlComment .= "// Generated: {$timestamp}\n";
        $htmlComment .= "// Filename: {$filename}\n";
        $htmlComment .= "// Use Upload: {$useUpload} ({$logoSource})\n";
        $htmlComment .= "// Tujuan: {$tujuan}\n";
        $htmlComment .= "// Author: " . (Auth::user()->name ?? 'Unknown') . "\n";
        $htmlComment .= "// User ID: " . Auth::id() . "\n";
        $htmlComment .= "\n";
        $htmlComment .= "// {$imageInstructions}\n";
        $htmlComment .= "// Logo Preview: {$logoPreview}\n";
        $htmlComment .= "\n";
        $htmlComment .= "// Links Count: " . count($this->links) . "\n";
        foreach ($this->links as $index => $link) {
            $htmlComment .= "// Link " . ($index + 1) . ": " . ($link['judul'] ?? 'No Title') . " -> " . ($link['url'] ?? 'No URL') . "\n";
        }
        $htmlComment .= "\n";
        $htmlComment .= "// QR Code: " . ($this->styles['qrcode']['enabled'] ? 'Enabled' : 'Disabled') . "\n";
        $htmlComment .= "// QR Position: " . ($this->styles['qrcode']['position'] ?? 'bottom-right') . "\n";
        $htmlComment .= "// QR Size: " . ($this->styles['qrcode']['size'] ?? '200') . "px\n";
        $htmlComment .= "\n";
        $htmlComment .= "// Footer: " . (!empty($this->footerText1) || !empty($this->footerText2) ? 'Custom' : 'Default') . "\n";
        if (!empty($this->footerText1)) {
            $htmlComment .= "// Footer Line 1: " . $this->footerText1 . "\n";
        }
        if (!empty($this->footerText2)) {
            $htmlComment .= "// Footer Line 2: " . $this->footerText2 . "\n";
        }
        $htmlComment .= "-->\n\n";

        return $htmlComment;
    }

    private function getOgImageUrl()
    {
        // Check if QR Code is enabled and has custom styling
        $qrSettings = $this->styles['qrcode'] ?? [];
        if ($qrSettings['enabled'] ?? false) {
            // Generate OG Image with QR Code styling
            return $this->generateQrCodeOgImage();
        }

        // Fallback to traditional logo-based OG Image
        if ($this->useUploadedLogo && !empty($this->logoPreviewUrl)) {
            // Untuk upload mode - prediksi URL final di GitHub Pages
            if ($this->logoUpload) {
                $extension = $this->logoUpload->getClientOriginalExtension();
                return "https://bps2172.github.io/TautPinang/images/{$this->slug}-logo.{$extension}";
            }
        }

        // Mode URL atau fallback
        return $this->logoUrl ?: 'https://bps2172.github.io/TautPinang/images/default-logo.png';
    }

    /**
     * Generate OG Image URL with QR Code styling
     */
    private function generateQrCodeOgImage()
    {
        $qrSettings = $this->styles['qrcode'] ?? [];

        // Extract QR colors
        $bgColor = $qrSettings['backgroundColor'] ?? '#ffffff';
        $darkColor = $qrSettings['darkColor'] ?? '#000000';

        // Convert RGBA to hex if needed
        $bgColorHex = $this->rgbaToHex($bgColor);
        $darkColorHex = $this->rgbaToHex($darkColor);

        // Remove # for API compatibility
        $bgColorApi = ltrim($bgColorHex, '#');
        $darkColorApi = ltrim($darkColorHex, '#');

        // Build QR Code URL for OG Image
        $qrSize = 400; // OG Image standard size
        $data = urlencode($this->judul ?? 'Taut Pinang');

        // Use API with custom colors
        $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size={$qrSize}x{$qrSize}&data={$data}&color={$darkColorApi}&bgcolor={$bgColorApi}&margin=2";

        return $qrUrl;
    }

    private function buildOgTags($title, $description, $slug, $imageUrl)
    {
        $url = "https://bps2172.github.io/TautPinang/{$slug}.html";
        $titleWithBranding = "{$title} | Taut Pinang";
        $safeTitle = htmlspecialchars($titleWithBranding, ENT_QUOTES, 'UTF-8');
        $safeDesc = htmlspecialchars($description ?: "Halaman tautan resmi {$title} - BPS Kota Tanjungpinang", ENT_QUOTES, 'UTF-8');
        $safeImageUrl = htmlspecialchars($imageUrl, ENT_QUOTES, 'UTF-8');

        return "    <meta property=\"og:title\" content=\"{$safeTitle}\">
    <meta property=\"og:description\" content=\"{$safeDesc}\">
    <meta property=\"og:type\" content=\"website\">
    <meta property=\"og:url\" content=\"{$url}\">
    <meta property=\"og:image\" content=\"{$safeImageUrl}\">
    <meta property=\"og:image:width\" content=\"400\">
    <meta property=\"og:image:height\" content=\"400\">
    <meta property=\"og:site_name\" content=\"Taut Pinang - BPS Kota Tanjungpinang\">
    <meta property=\"og:locale\" content=\"id_ID\">
    <meta name=\"twitter:card\" content=\"summary\">
    <meta name=\"twitter:title\" content=\"{$safeTitle}\">
    <meta name=\"twitter:description\" content=\"{$safeDesc}\">
    <meta name=\"twitter:image\" content=\"{$safeImageUrl}\">
    <meta name=\"author\" content=\"BPS Kota Tanjungpinang\">
    <meta name=\"robots\" content=\"index, follow\">";
    }

    private function buildCompleteHtml($filenameComment, $title, $desc, $css, $logo, $linkItems, $footerContent)
    {
        $descriptionHtml = $desc ? "\n        <p class=\"description\">{$desc}</p>" : "";

        // Generate OG tags
        $ogImageUrl = $this->getOgImageUrl();
        $ogTags = $this->buildOgTags($title, $desc, $this->slug, $ogImageUrl);

        // QR Code JavaScript
        $qrCodeScript = $this->buildQRCodeScript();

        // Format title dengan branding Taut Pinang
        $pageTitle = "{$title} | Taut Pinang";

        // BARU: Ambil warna dari styles untuk tombol copy
        $container = $this->styles['container'];
        $title_style = $this->styles['title'];

        // Tentukan background color tombol berdasarkan tipe background container
        $buttonBgColor = '#3B82F6'; // default fallback
        if ($container['backgroundType'] === 'gradient') {
            $buttonBgColor = $container['backgroundGradientStart'] ?? '#3B82F6';
        } else {
            $buttonBgColor = $container['backgroundColor'] ?? '#3B82F6';
        }

        // Ambil warna icon dari title color
        $iconColor = $title_style['color'] ?? '#FFFFFF';

        // Escape colors untuk HTML
        $safeButtonBgColor = htmlspecialchars($buttonBgColor, ENT_QUOTES, 'UTF-8');
        $safeIconColor = htmlspecialchars($iconColor, ENT_QUOTES, 'UTF-8');

        return $filenameComment . "<!DOCTYPE html>
<html lang=\"id\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>{$pageTitle}</title>
{$ogTags}
    <link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
    <link rel=\"preconnect\" href=\"https://fonts.gstatic.com\" crossorigin>
    <link href=\"https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap\" rel=\"stylesheet\">
    <link rel=\"icon\" href=\"images/favicon.png\" type=\"image/png\">
    <style>
{$css}
    </style>
</head>
<body>
    <!-- Copy Link Button -->
    <button id=\"copyLinkBtn\" onclick=\"copyCurrentUrl()\"
            style=\"position: fixed; top: 20px; right: 20px; z-index: 1000; background: {$safeButtonBgColor}; color: {$safeIconColor}; border: none; padding: 12px; border-radius: 50%; box-shadow: 0 4px 12px rgba(0,0,0,0.15); cursor: pointer; transition: all 0.3s ease; width: 48px; height: 48px; display: flex; align-items: center; justify-content: center;\">
        <svg width=\"20\" height=\"20\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
            <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z\"></path>
        </svg>
    </button>

    <div class=\"container\">
        <div class=\"logo\">
            <img src=\"{$logo}\" alt=\"Logo BPS\" onerror=\"this.style.display='none'\">
        </div>
        <h1 class=\"title\">{$title}</h1>{$descriptionHtml}
        <div class=\"links\">
{$linkItems}        </div>
        {$footerContent}
    </div>
{$qrCodeScript}

    <!-- Copy Button JavaScript -->
    <script>
    function copyCurrentUrl() {
        const url = window.location.href;

        if (navigator.clipboard) {
            navigator.clipboard.writeText(url).then(() => {
                showCopySuccess();
            }).catch(() => {
                fallbackCopy(url);
            });
        } else {
            fallbackCopy(url);
        }
    }

    function fallbackCopy(text) {
        const textArea = document.createElement('textarea');
        textArea.value = text;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        showCopySuccess();
    }

    function showCopySuccess() {
        const btn = document.getElementById('copyLinkBtn');
        const originalContent = btn.innerHTML;
        const originalBg = btn.style.background;

        btn.innerHTML = '<svg width=\"20\" height=\"20\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M5 13l4 4L19 7\"></path></svg>';
        btn.style.background = '#10B981';

        setTimeout(() => {
            btn.innerHTML = originalContent;
            btn.style.background = originalBg;
        }, 2000);
    }

    // Hover effects - UPDATED: menggunakan warna yang dinamis
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('copyLinkBtn');
        const originalBg = '{$safeButtonBgColor}';

        // Generate darker version untuk hover (kurangi opacity atau darken)
        const hoverBg = adjustColorBrightness(originalBg, -20);

        btn.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1)';
            this.style.background = hoverBg;
        });

        btn.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
            this.style.background = originalBg;
        });

        // Helper function untuk adjust brightness
        function adjustColorBrightness(color, amount) {
            // Jika rgba, extract RGB values
            const rgbaMatch = color.match(/rgba\\((\\d+),\\s*(\\d+),\\s*(\\d+),\\s*([\\d.]+)\\)/);
            if (rgbaMatch) {
                let r = Math.max(0, Math.min(255, parseInt(rgbaMatch[1]) + amount));
                let g = Math.max(0, Math.min(255, parseInt(rgbaMatch[2]) + amount));
                let b = Math.max(0, Math.min(255, parseInt(rgbaMatch[3]) + amount));
                let a = rgbaMatch[4];
                return 'rgba(' + r + ', ' + g + ', ' + b + ', ' + a + ')';
            }

            // Jika hex color
            const hexMatch = color.match(/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/);
            if (hexMatch) {
                let hex = hexMatch[1];
                if (hex.length === 3) {
                    hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
                }
                let r = Math.max(0, Math.min(255, parseInt(hex.substr(0, 2), 16) + amount));
                let g = Math.max(0, Math.min(255, parseInt(hex.substr(2, 2), 16) + amount));
                let b = Math.max(0, Math.min(255, parseInt(hex.substr(4, 2), 16) + amount));
                return 'rgb(' + r + ', ' + g + ', ' + b + ')';
            }

            // Fallback
            return color;
        }
    });
    </script>
</body>
</html>";
    }

    private function buildQRCodeScript()
    {
        $qrSettings = $this->styles['qrcode'] ?? [];

        if (!($qrSettings['enabled'] ?? true)) {
            return '';
        }

        $position = $qrSettings['position'] ?? 'bottom-right';
        $size = $qrSettings['size'] ?? '100';
        $backgroundColor = $qrSettings['backgroundColor'] ?? '#ffffff';
        $borderColor = $qrSettings['borderColor'] ?? '#ffffff';
        $darkColor = $qrSettings['darkColor'] ?? '#000000';
        $borderRadius = $qrSettings['borderRadius'] ?? '12';
        $padding = $qrSettings['padding'] ?? '10';
        $tooltipText = $qrSettings['tooltipText'] ?? 'Scan QR untuk buka halaman ini';
        $showOnMobile = $qrSettings['showOnMobile'] ?? false;

        $positionStyles = $this->getQRPositionStyles($position);

        // Convert colors to hex for API
        $darkColorHex = ltrim($this->rgbaToHex($darkColor), '#');
        $bgColorHex = ltrim($this->rgbaToHex($backgroundColor), '#');

        return "
<!-- QR Code Generator -->
<script>
(function() {
    function generateQRCode() {
        const qrSettings = {
            enabled: true,
            position: '{$position}',
            size: {$size},
            backgroundColor: '{$backgroundColor}',
            borderColor: '{$borderColor}',
            borderRadius: '{$borderRadius}',
            padding: '{$padding}',
            tooltipText: '{$tooltipText}',
            darkColor: '{$darkColor}',
            showOnMobile: " . ($showOnMobile ? 'true' : 'false') . "
        };

        if (!qrSettings.enabled) return;

        // Remove existing QR code
        const existingQR = document.getElementById('qr-code-container');
        if (existingQR) existingQR.remove();

        const currentUrl = window.location.href;

        // Create QR container
        const qrContainer = document.createElement('div');
        qrContainer.id = 'qr-code-container';
        qrContainer.style.cssText = 'position: fixed; {$positionStyles} background: {$backgroundColor}; padding: {$padding}px; border-radius: {$borderRadius}px; z-index: 1000; border: 2px solid {$borderColor}; cursor: pointer; user-select: none; display: flex; align-items: center; justify-content: center;';

        // Mobile visibility
        if (!qrSettings.showOnMobile) {
            function toggleQRVisibility() {
                qrContainer.style.display = window.innerWidth <= 768 ? 'none' : 'flex';
            }
            toggleQRVisibility();
            window.addEventListener('resize', toggleQRVisibility);
        }

        // Create QR image using API
        const img = document.createElement('img');
        img.src = 'https://api.qrserver.com/v1/create-qr-code/?size={$size}x{$size}&data=' + encodeURIComponent(currentUrl) + '&color={$darkColorHex}&bgcolor={$bgColorHex}&margin=1';
        img.alt = 'QR Code';
        img.style.cssText = 'width: {$size}px; height: {$size}px; display: block; border-radius: 4px;';

        qrContainer.appendChild(img);
        document.body.appendChild(qrContainer);

        console.log('✅ QR Code generated successfully');
    }

    // Generate QR when page loads
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', generateQRCode);
    } else {
        generateQRCode();
    }
})();
</script>";
    }

    private function getQRPositionStyles($position)
    {
        switch ($position) {
            case 'top-left':
                return 'top: 80px; left: 20px;';
            case 'top-right':
                return 'top: 80px; right: 20px;';
            case 'bottom-left':
                return 'bottom: 20px; left: 20px;';
            case 'bottom-right':
            default:
                return 'bottom: 20px; right: 20px;';
        }
    }

    private function buildPlaceholderHtml()
    {
        return "<!DOCTYPE html>
<html lang=\"id\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>Preview | Taut Pinang</title>
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            margin: 0;
        }
        .placeholder {
            background: white;
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            color: #6b7280;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .icon {
            font-size: 48px;
            margin-bottom: 16px;
        }
        .text {
            font-size: 16px;
            margin-bottom: 8px;
        }
        .subtext {
            font-size: 14px;
            opacity: 0.7;
        }
    </style>
</head>
<body>
    <div class=\"placeholder\">
        <div class=\"icon\">📱</div>
        <div class=\"text\">Live Preview | Taut Pinang</div>
        <div class=\"subtext\">Isi judul dan tambahkan link untuk melihat preview</div>
    </div>
</body>
</html>";
    }

    private function buildOptimizedCSS()
    {
        $bg = $this->styles['background'];
        $container = $this->styles['container'];
        $title = $this->styles['title'];
        $desc = $this->styles['description'];
        $button = $this->styles['button'];
        $buttonHover = $this->styles['buttonHover'];
        $logo = $this->styles['logo'];
        $footer = $this->styles['footer'];

        $backgroundGradient = $this->buildGradient(
            $bg['gradientStart'] ?? '#002366',
            $bg['gradientEnd'] ?? '#1D4E5F',
            $bg['direction'] ?? '135'
        );

        $topGradient = $this->buildGradient(
            $container['topGradientStart'] ?? '#FFD700',
            $container['topGradientEnd'] ?? '#002366',
            '90'
        );

        $buttonHoverBg = $this->buildGradient(
            $buttonHover['backgroundStart'] ?? '#FFD700',
            $buttonHover['backgroundEnd'] ?? '#FFFFFF',
            '135'
        );

        $containerBackground = $this->buildBackgroundStyle($container);
        $logoBackground = $this->buildBackgroundStyle($logo);
        $logoBorderRadius = isset($logo['borderRadius']) ? $logo['borderRadius'] . 'px' : '50px';
        $bgAnimationCSS = ''; // No animations

        return $this->buildCSSString([
            'backgroundGradient' => $backgroundGradient,
            'topGradient' => $topGradient,
            'buttonHoverBg' => $buttonHoverBg,
            'containerBackground' => $containerBackground,
            'logoBackground' => $logoBackground,
            'logoBorderRadius' => $logoBorderRadius,
            'bgAnimationCSS' => $bgAnimationCSS,
            'container' => $container,
            'title' => $title,
            'desc' => $desc,
            'button' => $button,
            'buttonHover' => $buttonHover,
            'logo' => $logo,
            'footer' => $footer
        ]);
    }

    private function buildGradient($startColor, $endColor, $direction)
    {
        return "background: linear-gradient({$direction}deg, {$startColor}, {$endColor});";
    }

    private function buildBackgroundStyle($config)
    {
        $type = $config['backgroundType'] ?? 'solid';

        if ($type === 'gradient') {
            return $this->buildGradient(
                $config['backgroundGradientStart'] ?? '#FFFFFF',
                $config['backgroundGradientEnd'] ?? '#F8FAFC',
                $config['backgroundGradientDirection'] ?? '135'
            );
        } else {
            return isset($config['backgroundColor']) ? "background: {$config['backgroundColor']};" : 'background: #FFFFFF;';
        }
    }

    private function buildCSSString($params)
    {
        extract($params);

        return "        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            {$backgroundGradient}
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
            overflow-y: auto;
        }

{$bgAnimationCSS}

        .container {
            {$containerBackground}
            backdrop-filter: blur({$container['backdropBlur']}px);
            border-radius: {$container['borderRadius']}px;
            padding: 30px 25px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 350px;
            width: 100%;
            animation: fadeInUp 0.6s ease-out;
            position: relative;
            overflow: hidden;
            z-index: 10;
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: {$container['topGradientHeight']}px;
            {$topGradient}
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo {
            width: 80px;
            height: 80px;
            margin: 20px auto 20px;
            border-radius: {$logoBorderRadius};
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            {$logoBackground}
            display: flex;
            align-items: center;
            justify-content: center;
            border: {$logo['borderWidth']}px {$logo['borderStyle']} {$logo['borderColor']};
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .title {
            font-size: {$title['fontSize']}px;
            font-weight: {$title['fontWeight']};
            color: {$title['color']};
            margin-bottom: 8px;
            line-height: 1.3;
        }

        .description {
            color: {$desc['color']};
            font-size: {$desc['fontSize']}px;
            margin-bottom: 25px;
            line-height: 1.5;
        }

        .links {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .link-button {
            display: block;
            padding: 16px 20px;
            text-decoration: none;
            border-radius: {$button['borderRadius']}px;
            font-weight: 600;
            font-size: 15px;
            border: {$button['borderWidth']}px {$button['borderStyle']} {$button['borderColor']};
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .link-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 {$buttonHover['glowBlur']}px {$buttonHover['glowColor']};
        }

        .footer {
            margin-top: {$footer['marginTop']}px;
            padding-top: {$footer['paddingTop']}px;
            border-top: 1px solid {$footer['borderColor']};
            color: {$footer['color']};
            font-size: {$footer['fontSize']}px;
        }


        @media (max-width: 768px) {
            #qr-code-container {
                display: none !important;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 25px 20px;
            }

            .title {
                font-size: calc({$title['fontSize']}px * 0.85);
            }

            .link-button {
                padding: 14px 18px;
                font-size: 14px;
            }
        }";
    }

    public function resetForm()
    {
        // Reload original data instead of clearing
        $this->loadTautan();
        $this->generatePreview();
        session()->flash('success', 'Form berhasil direset ke data asli!');
    }

    public function getGithubUrlProperty()
    {
        if (empty($this->slug)) {
            return 'https://bps2172.github.io/TautPinang/preview.html';
        }
        return 'https://bps2172.github.io/TautPinang/' . $this->slug . '.html';
    }

    public function render()
    {
        return view('livewire.edit-tautan');
    }

    /**
     * ✅ VALIDASI SLUG - Cek Reserved Slugs
     */
    protected function validateSlug()
    {
        $reservedSlugs = [
            'dashboard',
            'login',
            'register',
            'logout',
            'password',
            'tautan',
            'admin',
            'api',
            'home',
            'about',
            'contact',
            'privacy',
            'terms',
            'user',
            'profile',
            'settings'
        ];

        if (in_array(strtolower($this->slug), $reservedSlugs)) {
            $this->addError('slug', 'Slug "' . $this->slug . '" tidak dapat digunakan.');
            return false;
        }

        return true;
    }

    /**
     * Convert hex color to RGBA with opacity
     */
    private function hexToRgba($hex, $opacity)
    {
        // Remove # if present
        $hex = ltrim($hex, '#');

        // Parse hex to RGB
        if (strlen($hex) === 3) {
            $r = hexdec(str_repeat(substr($hex, 0, 1), 2));
            $g = hexdec(str_repeat(substr($hex, 1, 1), 2));
            $b = hexdec(str_repeat(substr($hex, 2, 1), 2));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }

        return "rgba($r, $g, $b, $opacity)";
    }
}