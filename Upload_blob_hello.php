<?PHP


require_once 'vendor/autoload.php';
require_once "./random_string.php";

use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;
use MicrosoftAzure\Storage\Blob\Models\ListBlobsOptions;
use MicrosoftAzure\Storage\Blob\Models\CreateContainerOptions;
use MicrosoftAzure\Storage\Blob\Models\PublicAccessType;

$connectionString = "DefaultEndpointsProtocol=https;AccountName=wahyuwebapp;AccountKey=m8HpCvMx+p/cjmQT5DOVY5uFd2NpqJ+f7WcBI68nqCrcwd29C/q+u2O5ZLArZYcLn7wCBM36fpLQQzPHXgSwgw==;EndpointSuffix=core.windows.net";

// Create blob client.
$blobClient = BlobRestProxy::createBlobService($connectionString);

$fileToUpload = "building.png";


  if(!empty($_FILES['uploaded_file']))
  {
    $path = "uploads/";
    $path = $path . basename( $_FILES['uploaded_file']['name']);
    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
      echo "The file ".  basename( $_FILES['uploaded_file']['name']). 
      " has been uploaded";
    } else{
        echo "There was an error uploading the file, please try again!";
    }
  }


// if (!isset($_GET["Cleanup"])) {
//     // Create container options object.
//     $createContainerOptions = new CreateContainerOptions();

//     // Set public access policy. Possible values are
//     // PublicAccessType::CONTAINER_AND_BLOBS and PublicAccessType::BLOBS_ONLY.
//     // CONTAINER_AND_BLOBS:
//     // Specifies full public read access for container and blob data.
//     // proxys can enumerate blobs within the container via anonymous
//     // request, but cannot enumerate containers within the storage account.
//     //
//     // BLOBS_ONLY:
//     // Specifies public read access for blobs. Blob data within this
//     // container can be read via anonymous request, but container data is not
//     // available. proxys cannot enumerate blobs within the container via
//     // anonymous request.
//     // If this value is not specified in the request, container data is
//     // private to the account owner.
//     $createContainerOptions->setPublicAccess(PublicAccessType::CONTAINER_AND_BLOBS);

//     // Set container metadata.
//     $createContainerOptions->addMetaData("key1", "value1");
//     $createContainerOptions->addMetaData("key2", "value2");

//       $containerName = "blockblobs".generateRandomString();

//     try {
//         // Create container.
//         $blobClient->createContainer($containerName, $createContainerOptions);

//         // Getting local file so that we can upload it to Azure
//         $myfile = fopen($fileToUpload, "r") or die("Unable to open file!");
//         fclose($myfile);
        
//         # Upload file as a block blob
//         echo "Uploading BlockBlob: ".PHP_EOL;
//         echo $fileToUpload;
//         echo "<br />";
        
//         $content = fopen($fileToUpload, "r");

//         //Upload blob
//         $blobClient->createBlockBlob($containerName, $fileToUpload, $content);

//         // List blobs.
//         $listBlobsOptions = new ListBlobsOptions();
//         $listBlobsOptions->setPrefix("HelloWorld");

//         echo "These are the blobs present in the container: ";

//         do{
//             $result = $blobClient->listBlobs($containerName, $listBlobsOptions);
//             foreach ($result->getBlobs() as $blob)
//             {
//                 echo $blob->getName().": ".$blob->getUrl()."<br />";
//             }
        
//             $listBlobsOptions->setContinuationToken($result->getContinuationToken());
//         } while($result->getContinuationToken());
//         echo "<br />";

//         // Get blob.
//         echo "This is the content of the blob uploaded: ";
//         $blob = $blobClient->getBlob($containerName, $fileToUpload);
//         fpassthru($blob->getContentStream());
//         echo "<br />";
//     }
//     catch(ServiceException $e){
//         // Handle exception based on error codes and messages.
//         // Error codes and messages are here:
//         // http://msdn.microsoft.com/library/azure/dd179439.aspx
//         $code = $e->getCode();
//         $error_message = $e->getMessage();
//         echo $code.": ".$error_message."<br />";
//     }
//     catch(InvalidArgumentTypeException $e){
//         // Handle exception based on error codes and messages.
//         // Error codes and messages are here:
//         // http://msdn.microsoft.com/library/azure/dd179439.aspx
//         $code = $e->getCode();
//         $error_message = $e->getMessage();
//         echo $code.": ".$error_message."<br />";
//     }
// } 
// else 
// {

//     try{
//         // Delete container.
//         echo "Deleting Container".PHP_EOL;
//         echo $_GET["containerName"].PHP_EOL;
//         echo "<br />";
//         $blobClient->deleteContainer($_GET["containerName"]);
//     }
//     catch(ServiceException $e){
//         // Handle exception based on error codes and messages.
//         // Error codes and messages are here:
//         // http://msdn.microsoft.com/library/azure/dd179439.aspx
//         $code = $e->getCode();
//         $error_message = $e->getMessage();
//         echo $code.": ".$error_message."<br />";
//     }
// }
?>


<form method="post" action="Upload_blob_hello.php?Cleanup&containerName=<?php echo $containerName; ?>">
    <button type="submit">Press to clean up all resources created by this sample</button>
</form>

<form method="POST" action="upload_blob_hello.php" enctype="multipart/form-data">
    <div>
      <span>Upload a File:</span>
      <input type="file" name="uploadedFile" />
    </div>
 
    <input type="submit" name="uploadBtn" value="Upload"/>
  </form>
