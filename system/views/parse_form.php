<form action="parse.php" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-6">
            <h2>Upload and Parse files</h2>
            <div class="form-group">
                <label for="fileToUpload">Select XML/JSON file:</label>
                <input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload">
            </div>
            <input type="submit" value="Upload and Parse Files" name="submit">
        </div>

        <div class="col-md-6">
            <h2>Parse files from URL</h2>
        </div>
    </div>
</form>