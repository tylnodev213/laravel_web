function readFile() {

    if (!this.files || !this.files[0]) return;

    const FR = new FileReader();

    FR.addEventListener("load", function(evt) {
        document.querySelector("#preview").src         = evt.target.result;
        document.querySelector("#b64").value = evt.target.result;
    });

    FR.readAsDataURL(this.files[0]);

}

document.querySelector("#inputGroupFile").addEventListener("change", readFile);

