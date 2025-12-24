<?php

namespace App\Console\Commands;

use App\Models\Gallery\GallerySubmission;
use Illuminate\Console\Command;
use Intervention\Image\Facades\Image;

class RegenerateGalleryThumbnails extends Command
{
    protected $signature = 'thumbnails:regenerate-gallery';
    protected $description = 'Regenerates all gallery submission thumbnails';

    public function handle()
    {
        $submissions = GallerySubmission::whereNotNull('hash')->get();
        $this->info("Regenerating {$submissions->count()} gallery thumbnails...");
        
        $bar = $this->output->createProgressBar($submissions->count());
        $bar->start();

        foreach ($submissions as $submission) {
            try {
                if (file_exists($submission->imagePath.'/'.$submission->imageFileName)) {
                    Image::make($submission->imagePath.'/'.$submission->imageFileName)
                        ->resize(
                            config('lorekeeper.settings.masterlist_thumbnails.width'),
                            config('lorekeeper.settings.masterlist_thumbnails.height'),
                            function ($constraint) {
                                $constraint->aspectRatio();
                                $constraint->upsize();
                            }
                        )
                        ->resizeCanvas(
                            config('lorekeeper.settings.masterlist_thumbnails.width'),
                            config('lorekeeper.settings.masterlist_thumbnails.height'),
                            'center',
                            false,
                            null
                        )
                        ->save($submission->thumbnailPath.'/'.$submission->thumbnailFileName);
                }
            } catch (\Exception $e) {
                $this->error("\nFailed for submission #{$submission->id}: " . $e->getMessage());
            }
            
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info('Gallery thumbnails regenerated successfully!');
    }
}