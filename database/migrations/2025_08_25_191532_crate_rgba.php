<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Tautan;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // First, ensure the table has the necessary structure
        Schema::table('tautans', function (Blueprint $table) {
            // Add any missing columns if they don't exist
            if (!Schema::hasColumn('tautans', 'styles')) {
                $table->json('styles')->nullable()->after('links');
            }

            if (!Schema::hasColumn('tautans', 'logo_url')) {
                $table->string('logo_url', 500)->nullable()->after('styles');
            }

            if (!Schema::hasColumn('tautans', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('logo_url');
            }
        });

        // Add indexes for better performance (with error handling)
        try {
            Schema::table('tautans', function (Blueprint $table) {
                // Try to add composite index
                $table->index(['user_id', 'is_active'], 'idx_tautans_user_active');
            });
        } catch (\Exception $e) {
            // Index might already exist, that's okay
        }

        try {
            Schema::table('tautans', function (Blueprint $table) {
                // Try to add slug index
                $table->index('slug', 'idx_tautans_slug');
            });
        } catch (\Exception $e) {
            // Index might already exist, that's okay
        }

        // Convert existing hex-based styles to RGBA format
        $this->convertExistingStylesToRGBA();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Note: We don't reverse the RGBA conversion as it's backward compatible
        try {
            Schema::table('tautans', function (Blueprint $table) {
                // Remove indexes if they exist
                $table->dropIndex('idx_tautans_user_active');
                $table->dropIndex('idx_tautans_slug');
            });
        } catch (\Exception $e) {
            // Indexes might not exist, that's okay
        }
    }

    /**
     * Convert existing hex-based styles to RGBA format
     *
     * @return void
     */
    private function convertExistingStylesToRGBA()
    {
        try {
            // Check if Tautan model exists and table has data
            if (!class_exists('\App\Models\Tautan')) {
                echo "⚠️  Tautan model not found, skipping conversion.\n";
                return;
            }

            // Get all existing tautans with non-null styles
            $tautans = \App\Models\Tautan::whereNotNull('styles')->get();

            if ($tautans->count() === 0) {
                echo "ℹ️  No existing tautans with styles found, skipping conversion.\n";
                return;
            }

            echo "🔄 Converting {$tautans->count()} existing tautan styles to RGBA format...\n";

            $converted = 0;
            foreach ($tautans as $tautan) {
                try {
                    $styles = $tautan->styles;

                    // Check if this is old hex-based format
                    if ($this->hasOldStyleFormat($styles)) {
                        // Use the conversion method
                        $convertedStyles = $this->convertHexToRgbaStyles($styles);

                        // Update the record
                        $tautan->update(['styles' => $convertedStyles]);

                        $converted++;
                        echo "✅ Converted styles for Tautan ID: {$tautan->id} (slug: {$tautan->slug})\n";
                    } else {
                        echo "ℹ️  Tautan ID: {$tautan->id} already uses RGBA format\n";
                    }
                } catch (\Exception $e) {
                    echo "❌ Error converting Tautan ID: {$tautan->id} - " . $e->getMessage() . "\n";
                    continue;
                }
            }

            echo "🎨 RGBA conversion completed! Converted {$converted} records.\n";
        } catch (\Exception $e) {
            echo "⚠️  Error during RGBA conversion: " . $e->getMessage() . "\n";
            echo "ℹ️  This is non-critical, your application will still work.\n";
        }
    }

    /**
     * Check if styles use old hex format
     *
     * @param array|null $styles
     * @return bool
     */
    private function hasOldStyleFormat($styles)
    {
        if (!is_array($styles)) return false;

        // Check if we have old gradient format
        if (isset($styles['background']['gradient']) && strpos($styles['background']['gradient'], ',') !== false) {
            return true;
        }

        // Check if we have old hex colors
        if (isset($styles['title']['color']) && strpos($styles['title']['color'], '#') === 0) {
            return true;
        }

        return false;
    }

    /**
     * Convert old hex-based styles to RGBA (copy of model method for migration)
     *
     * @param array $oldStyles
     * @return array
     */
    private function convertHexToRgbaStyles($oldStyles)
    {
        $newStyles = $this->getDefaultRgbaStyles();

        if (!is_array($oldStyles)) return $newStyles;

        // Convert background gradient
        if (isset($oldStyles['background']['gradient'])) {
            $colors = explode(',', $oldStyles['background']['gradient']);
            if (count($colors) >= 2) {
                $newStyles['background']['gradientStart'] = $this->hexToRgba(trim($colors[0]), 1);
                $newStyles['background']['gradientEnd'] = $this->hexToRgba(trim($colors[1]), 1);
            }
        }

        if (isset($oldStyles['background']['direction'])) {
            $newStyles['background']['direction'] = str_replace('deg', '', $oldStyles['background']['direction']);
        }

        // Convert container styles
        if (isset($oldStyles['container']['backgroundColor'])) {
            $newStyles['container']['backgroundColor'] = $this->convertColorToRgba($oldStyles['container']['backgroundColor']);
        }

        if (isset($oldStyles['container']['borderRadius'])) {
            $newStyles['container']['borderRadius'] = str_replace('px', '', $oldStyles['container']['borderRadius']);
        }

        // Convert typography
        if (isset($oldStyles['title']['color'])) {
            $newStyles['title']['color'] = $this->hexToRgba($oldStyles['title']['color'], 1);
        }

        if (isset($oldStyles['title']['fontSize'])) {
            $newStyles['title']['fontSize'] = str_replace('px', '', $oldStyles['title']['fontSize']);
        }

        if (isset($oldStyles['description']['color'])) {
            $newStyles['description']['color'] = $this->hexToRgba($oldStyles['description']['color'], 1);
        }

        if (isset($oldStyles['description']['fontSize'])) {
            $newStyles['description']['fontSize'] = str_replace('px', '', $oldStyles['description']['fontSize']);
        }

        // Convert button styles
        if (isset($oldStyles['button']['backgroundColor'])) {
            $newStyles['button']['backgroundColor'] = $this->hexToRgba($oldStyles['button']['backgroundColor'], 1);
        }

        if (isset($oldStyles['button']['color'])) {
            $newStyles['button']['color'] = $this->hexToRgba($oldStyles['button']['color'], 1);
        }

        // Convert other button properties
        $buttonProps = ['borderRadius', 'borderWidth'];
        foreach ($buttonProps as $prop) {
            if (isset($oldStyles['button'][$prop])) {
                $newStyles['button'][$prop] = str_replace('px', '', $oldStyles['button'][$prop]);
            }
        }

        return $newStyles;
    }

    /**
     * Get default RGBA styles
     *
     * @return array
     */
    private function getDefaultRgbaStyles()
    {
        return [
            'background' => [
                'gradientStart' => 'rgba(0, 35, 102, 1)', // #002366
                'gradientEnd' => 'rgba(29, 78, 95, 1)', // #1d4e5f
                'direction' => '135' // degrees
            ],
            'container' => [
                'backgroundColor' => 'rgba(255, 255, 255, 0.95)',
                'borderRadius' => '24', // px
                'backdropBlur' => '20', // px
                'topGradientStart' => 'rgba(255, 215, 0, 1)', // #ffd700
                'topGradientEnd' => 'rgba(0, 35, 102, 1)', // #002366
                'topGradientHeight' => '4' // px
            ],
            'title' => [
                'fontSize' => '26', // px
                'fontWeight' => '700',
                'color' => 'rgba(0, 35, 102, 1)' // #002366
            ],
            'description' => [
                'color' => 'rgba(102, 102, 102, 1)', // #666
                'fontSize' => '15' // px
            ],
            'button' => [
                'backgroundColor' => 'rgba(255, 255, 255, 1)',
                'color' => 'rgba(0, 35, 102, 1)', // #002366
                'borderRadius' => '12', // px
                'borderColor' => 'rgba(234, 234, 234, 1)', // #eaeaea
                'borderWidth' => '2', // px
                'borderStyle' => 'solid'
            ],
            'buttonHover' => [
                'backgroundStart' => 'rgba(255, 215, 0, 1)', // #ffd700
                'backgroundEnd' => 'rgba(255, 255, 255, 1)', // #ffffff
                'color' => 'rgba(0, 35, 102, 1)', // #002366
                'glowColor' => 'rgba(255, 215, 0, 0.3)',
                'glowBlur' => '30', // px
                'borderColor' => 'rgba(255, 215, 0, 1)', // #ffd700
                'borderWidth' => '2', // px
                'borderStyle' => 'solid'
            ],
            'logo' => [
                'borderColor' => 'rgba(255, 215, 0, 1)', // #ffd700
                'borderWidth' => '3', // px
                'borderStyle' => 'solid'
            ],
            'animations' => [
                'fadeInDuration' => '0.6', // s
                'hoverDuration' => '0.3' // s
            ]
        ];
    }

    /**
     * Convert hex color to RGBA
     *
     * @param string $hex
     * @param float $alpha
     * @return string
     */
    private function hexToRgba($hex, $alpha = 1)
    {
        // Remove # if present
        $hex = ltrim($hex, '#');

        // Handle 3-character hex
        if (strlen($hex) == 3) {
            $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
        }

        // Convert to RGB
        if (strlen($hex) == 6) {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));

            return "rgba($r, $g, $b, $alpha)";
        }

        // Fallback for invalid hex
        return "rgba(0, 0, 0, $alpha)";
    }

    /**
     * Convert any color format to RGBA
     *
     * @param string $color
     * @return string
     */
    private function convertColorToRgba($color)
    {
        // If already RGBA, return as is
        if (strpos($color, 'rgba(') === 0) {
            return $color;
        }

        // If hex, convert to RGBA
        if (strpos($color, '#') === 0) {
            return $this->hexToRgba($color, 1);
        }

        // If named color or other format, try to preserve
        return $color;
    }
};
