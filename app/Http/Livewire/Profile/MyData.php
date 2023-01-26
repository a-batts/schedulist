<?php

namespace App\Http\Livewire\Profile;

use App\Enums\DataCategory;
use App\Helpers\DataHelper;
use Carbon\Carbon;
use Error;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use ZipArchive;

class MyData extends Component
{
    /**
     * Holds information about user's existing backup
     *
     * @var array
     */

    public array $existingBackup;

    /**
     * Selected categories of data to be archived
     *
     * @var array
     */
    public array $selectedData = [];

    /**
     * The storage path for archive zips
     */
    private const STORAGE_PATH = 'app/exported-archives/';

    /**
     * Create zip archive and return download to user
     *
     * @return BinaryFileResponse|null
     */
    public function createArchive(): ?BinaryFileResponse
    {
        $dataHelper = new DataHelper(Auth::user());
        $zip = new ZipArchive();
        $fileName =
            Auth::user()->firstname .
            '_' .
            Carbon::now()->format('Y-m-dHis') .
            '_archive.zip';

        if (
            $zip->open(
                storage_path(self::STORAGE_PATH . $fileName),
                ZipArchive::CREATE
            ) === true
        ) {
            $existArchive = DB::table('user_archives')
                ->where('user_id', Auth::id())
                ->first();

            if (isset($existArchive)) {
                unlink(
                    storage_path(self::STORAGE_PATH . $existArchive->filename)
                );
            }

            DB::table('user_archives')
                ->where('user_id', Auth::id())
                ->delete();

            foreach ($this->selectedData as $category) {
                $data = json_encode(
                    $dataHelper->getData(DataCategory::from($category))
                );

                if ($category == 'profile') {
                    $zip->addEmptyDir('profile');
                    $zip->addFromString('profile/profile-info.json', $data);

                    $profilePhoto = Auth::user()->profile_photo_path;

                    if (isset($profilePhoto)) {
                        $zip->addFile(
                            public_path('storage/' . $profilePhoto),
                            'profile/profile-photo.' .
                                explode('.', $profilePhoto)[1]
                        );
                    }
                } else {
                    $zip->addFromString("$category.json", $data);
                }
            }
            $zip->close();

            DB::table('user_archives')->insert([
                'user_id' => Auth::id(),
                'filename' => $fileName,
                'backup_contains' => implode(',', $this->selectedData),
                'created_at' => Carbon::now(),
            ]);

            $this->dispatchBrowserEvent('started-download');
            return response()->download(
                storage_path(self::STORAGE_PATH . $fileName)
            );
        }

        $this->emit(
            'toastMessage',
            'Something went wrong. Please try that action again.'
        );
        return null;
    }

    /**
     * Delete a specified category's data
     *
     * @param string $category
     * @return void
     */
    public function deleteData(string $category): void
    {
        $dataHelper = new DataHelper(Auth::user());
        try {
            $dataHelper->deleteData(DataCategory::from($category));
            $this->emit(
                'toastMessage',
                "Your $category have been successfully deleted."
            );
        } catch (Error) {
            $this->emit(
                'toastMessage',
                'Unable to delete the data you requested.'
            );
        }
    }

    /**
     * Re-download the last user created archive
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function redownload(): BinaryFileResponse
    {
        $this->dispatchBrowserEvent('finished-redownload');
        $archive = DB::table('user_archives')
            ->where('user_id', Auth::id())
            ->first();
        return response()->download(
            storage_path(self::STORAGE_PATH . $archive->filename)
        );
    }

    public function render()
    {
        $archive = DB::table('user_archives')
            ->where('user_id', Auth::id())
            ->first();
        if (isset($archive)) {
            $contains = '';

            $exploded = explode(',', $archive->backup_contains);
            sort($exploded);
            foreach ($exploded as $key => $data) {
                if ($key != count($exploded) - 1) {
                    $contains .= $data . ', ';
                } elseif (count($exploded) > 1) {
                    $contains .= ' and ' . $data;
                } else {
                    $contains = $data;
                }
            }
            $this->existingBackup = [
                'filename' => $archive->filename,
                'created' => Carbon::parse($archive->created_at)->format(
                    'F jS, Y'
                ),
                'daysOld' => Carbon::parse($archive->created_at)->diffInDays(
                    Carbon::now()
                ),
                'contains' => $contains,
            ];
        }
        return view('livewire.profile.my-data')
            ->layout('layouts.app')
            ->layoutData(['title' => 'Your Data']);
    }
}
