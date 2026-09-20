<?php

namespace App\Http\Controllers\Admin;

<<<<<<< HEAD
use App\Http\Controllers\Controller;
use App\Services\FileManager;
use Illuminate\Http\Request;

class FileController extends Controller {
    /**
     * Shows the files index.
     *
     * @param string $folder
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getIndex($folder = null) {
        $filesDirectory = public_path().'/files';

        // Create the files directory if it doesn't already exist.
        if (!file_exists($filesDirectory)) {
            // Create the directory.
            if (!mkdir($filesDirectory, 0755, true)) {
                $this->abort(500);

=======
use Illuminate\Http\Request;

use Auth;
use Config;

use App\Services\FileManager;

use App\Http\Controllers\Controller;

class FileController extends Controller
{
    /**
     * Shows the files index.
     *
     * @param  string  $folder
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getIndex($folder = null)
    {
        $filesDirectory = public_path().'/files';

        // Create the files directory if it doesn't already exist.
        if(!file_exists($filesDirectory))
        {
            // Create the directory.
            if (!mkdir($filesDirectory, 0755, true)) {
                $this->abort(500);
>>>>>>> Cylunny/extension/polls-and-forms
                return false;
            }
            chmod($filesDirectory, 0755);
        }
<<<<<<< HEAD
        if ($folder && !file_exists($filesDirectory.'/'.$folder)) {
            abort(404);
        }
        $dir = $filesDirectory.($folder ? '/'.$folder : '');
        $files = scandir($dir);
        $fileList = [];
        foreach ($files as $file) {
            if (is_file($dir.'/'.$file)) {
                $fileList[] = $file;
            }
        }

        return view('admin.files.index', [
            'folder'  => $folder,
            'folders' => glob(public_path().'/files/*', GLOB_ONLYDIR),
            'files'   => $fileList,
=======
        if($folder && !file_exists($filesDirectory.'/'.$folder)) abort(404);
        $dir = $filesDirectory.($folder ? '/'.$folder : '');
        $files = scandir($dir); 
        $fileList = [];
        foreach($files as $file)
        {
            if(is_file($dir. '/'.$file)) $fileList[] = $file;
        }
        return view('admin.files.index', [
            'folder' => $folder,
            'folders' => glob(public_path().'/files/*' , GLOB_ONLYDIR),
            'files' => $fileList
>>>>>>> Cylunny/extension/polls-and-forms
        ]);
    }

    /**
     * Creates a new directory in the files directory.
     *
<<<<<<< HEAD
     * @param App\Services\FileManager $service
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreateFolder(Request $request, FileManager $service) {
        $request->validate(['name' => 'required|alpha_dash']);

        if ($service->createDirectory(public_path().'/files/'.$request->get('name'))) {
            flash('Folder created successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

=======
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Services\FileManager  $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreateFolder(Request $request, FileManager $service)
    {
        $request->validate(['name' => 'required|alpha_dash']);

        if($service->createDirectory(public_path().'/files/'.$request->get('name'))) {
            flash('Folder created successfully.')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return redirect()->back();
    }

    /**
     * Moves a file in the files directory.
     *
<<<<<<< HEAD
     * @param App\Services\FileManager $service
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postMoveFile(Request $request, FileManager $service) {
=======
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Services\FileManager  $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postMoveFile(Request $request, FileManager $service)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        $request->validate(['destination' => 'required']);
        $oldDir = $request->get('folder');
        $newDir = $request->get('destination');

<<<<<<< HEAD
        if ($service->moveFile(
            public_path().'/files'.($oldDir ? '/'.$oldDir : ''),
            public_path().'/files'.($newDir != 'root' ? '/'.$newDir : ''),
            $request->get('filename')
        )) {
            flash('File moved successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

=======
        if($service->moveFile(public_path().'/files'.($oldDir ? '/' . $oldDir : ''),
        public_path().'/files'.($newDir != 'root' ? '/' . $newDir : ''),
        $request->get('filename'))) {
            flash('File moved successfully.')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return redirect()->back();
    }

    /**
     * Renames a file in the files directory.
     *
<<<<<<< HEAD
     * @param App\Services\FileManager $service
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRenameFile(Request $request, FileManager $service) {
=======
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Services\FileManager  $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRenameFile(Request $request, FileManager $service)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        $request->validate(['name' => 'required|regex:/^[a-z0-9\._-]+$/i']);
        $dir = $request->get('folder');
        $oldName = $request->get('filename');
        $newName = $request->get('name');

<<<<<<< HEAD
        if ($service->renameFile(public_path().'/files'.($dir ? '/'.$dir : ''), $oldName, $newName)) {
            flash('File renamed successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

=======
        if($service->renameFile(public_path().'/files'.($dir ? '/' . $dir : ''), $oldName, $newName)) {
            flash('File renamed successfully.')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return redirect()->back();
    }

    /**
     * Deletes a file in the files directory.
     *
<<<<<<< HEAD
     * @param App\Services\FileManager $service
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDeleteFile(Request $request, FileManager $service) {
=======
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Services\FileManager  $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDeleteFile(Request $request, FileManager $service)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        $request->validate(['filename' => 'required']);
        $dir = $request->get('folder');
        $name = $request->get('filename');

<<<<<<< HEAD
        if ($service->deleteFile(public_path().'/files'.($dir ? '/'.$dir : '').'/'.$name)) {
            flash('File deleted successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

=======
        if($service->deleteFile(public_path().'/files'.($dir ? '/' . $dir : '') . '/' . $name)) {
            flash('File deleted successfully.')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return redirect()->back();
    }

    /**
     * Uploads a file to the files directory.
     *
<<<<<<< HEAD
     * @param App\Services\FileManager $service
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postUploadFile(Request $request, FileManager $service) {
        $request->validate(['files.*' => 'file|required']);
        $dir = $request->get('folder');
        $files = $request->file('files');
        foreach ($files as $file) {
            if ($service->uploadFile($file, $dir, $file->getClientOriginalName())) {
                flash('File uploaded successfully.')->success();
            } else {
                foreach ($service->errors()->getMessages()['error'] as $error) {
                    flash($error)->error();
                }
            }
        }

=======
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Services\FileManager  $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postUploadFile(Request $request, FileManager $service)
    {
        $request->validate(['file' => 'required|file']);
        $dir = $request->get('folder');
        $file = $request->file('file');

        if($service->uploadFile($file, $dir, $file->getClientOriginalName())) {
            flash('File uploaded successfully.')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return redirect()->back();
    }

    /**
     * Renames a directory in the files directory.
     *
<<<<<<< HEAD
     * @param App\Services\FileManager $service
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRenameFolder(Request $request, FileManager $service) {
=======
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Services\FileManager  $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRenameFolder(Request $request, FileManager $service)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        $request->validate(['name' => 'required|regex:/^[a-z0-9\._-]+$/i']);
        $dir = public_path().'/files';
        $oldName = $request->get('folder');
        $newName = $request->get('name');

<<<<<<< HEAD
        if ($service->renameDirectory($dir, $oldName, $newName)) {
            flash('Folder renamed successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }

            return redirect()->back();
        }

=======
        if($service->renameDirectory($dir, $oldName, $newName)) {
            flash('Folder renamed successfully.')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
            return redirect()->back();
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return redirect()->to('admin/files/'.$newName);
    }

    /**
     * Deletes a directory in the files directory.
     *
<<<<<<< HEAD
     * @param App\Services\FileManager $service
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDeleteFolder(Request $request, FileManager $service) {
        $request->validate(['folder' => 'required']);
        $dir = $request->get('folder');

        if ($service->deleteDirectory(public_path().'/files/'.$dir)) {
            flash('Folder deleted successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }

            return redirect()->back();
        }

=======
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Services\FileManager  $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDeleteFolder(Request $request, FileManager $service)
    {
        $request->validate(['folder' => 'required']);
        $dir = $request->get('folder');

        if($service->deleteDirectory(public_path().'/files/'.$dir)) {
            flash('Folder deleted successfully.')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
            return redirect()->back();
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return redirect()->to('admin/files');
    }

    /**
     * Shows the site images index.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
<<<<<<< HEAD
    public function getSiteImages() {
        return view('admin.files.images', [
            'images' => config('lorekeeper.image_files'),
=======
    public function getSiteImages()
    {
        return view('admin.files.images', [
            'images' => Config::get('lorekeeper.image_files')
>>>>>>> Cylunny/extension/polls-and-forms
        ]);
    }

    /**
     * Uploads a site image file.
     *
<<<<<<< HEAD
     * @param App\Services\FileManager $service
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postUploadImage(Request $request, FileManager $service) {
        $request->validate(['file' => 'required|file']);
        $file = $request->file('file');
        $key = $request->get('key');
        $filename = config('lorekeeper.image_files.'.$key)['filename'];

        if ($service->uploadFile($file, null, $filename, false)) {
            flash('Image uploaded successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

=======
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Services\FileManager  $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postUploadImage(Request $request, FileManager $service)
    {
        $request->validate(['file' => 'required|file']);
        $file = $request->file('file');
        $key = $request->get('key');
        $filename = Config::get('lorekeeper.image_files.'.$key)['filename'];

        if($service->uploadFile($file, null, $filename, false)) {
            flash('Image uploaded successfully.')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return redirect()->back();
    }

    /**
     * Uploads a custom site CSS file.
     *
<<<<<<< HEAD
     * @param App\Services\FileManager $service
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postUploadCss(Request $request, FileManager $service) {
        $request->validate(['file' => 'required|file']);
        $file = $request->file('file');

        if ($service->uploadCss($file)) {
            flash('File uploaded successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

=======
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Services\FileManager  $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postUploadCss(Request $request, FileManager $service)
    {
        $request->validate(['file' => 'required|file']);
        $file = $request->file('file');

        if($service->uploadCss($file)) {
            flash('File uploaded successfully.')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return redirect()->back();
    }
}
