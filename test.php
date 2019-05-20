<div id="advancedUpload">Select Files</div>

<input type="button" value="Upload" id="startUpload">

<div id="status"></div>

<script>

$(document).ready(function()

{

var uploadObj = $("#advancedUpload").uploadFile({

url:"upload.php",

multiple:true,

dragDrop:true,

autoSubmit:false,

allowedTypes:"*",

fileName:"myfile",

formData: {"name":"Ravi","age":31},

maxFileSize:1024*1024,

maxFileCount:10,

dynamicFormData: function()

{

var data ={ location:"INDIA"}

return data;

},

showStatusAfterSuccess:false,

dragDropStr: "Drop Your Files",

abortStr:"abort",

cancelStr:"Cancel",

doneStr:"Done",

multiDragErrorStr: "Multi Drag Error.",

extErrorStr:"Extension Error",

sizeErrorStr:"Size Error",

uploadErrorStr:"Upload Error."

});

$("#startUpload").click(function()

{

uploadObj.

uploadObj.startUpload();

});

});

</script>