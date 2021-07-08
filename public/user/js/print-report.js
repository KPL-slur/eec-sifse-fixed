/**
 * Warning  Modal
 */
const modal = document.getElementById('warning-modal');

// When the user clicks on <span> (x), close the modal
document.getElementsByClassName("close")[0].onclick = function () {
    modal.style.display = "none";
    window.print();
};

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if (event.target == modal) {
        document.getElementById('warning-modal').style.display = "none";
    }
};

/**
 * SWAPPER GAMBAR
 */
let click = 0;
let swapper = document.getElementsByClassName("btn-swap");
Array.from(swapper).forEach((element) => {
    element.addEventListener("click", function (e) {
        click++;
        switch (click) {
            case 1:
                firstId = this.dataset.id;
                break;

            case 2:
                secondId = this.dataset.id;

                swappingSrc(
                    document.getElementById("image_" + firstId),
                    document.getElementById("image_" + secondId)
                );
                swapping(
                    document.getElementById("caption_" + firstId),
                    document.getElementById("caption_" + secondId)
                );

                click = 0;
                break;

            default:
                break;
        }
    });
});

/**
 * SWAPPER expert row
 */
let up = document.getElementsByClassName("btn-up");
Array.from(up).forEach((element) => {
    element.addEventListener("click", function (e) {
        firstIndex = this.dataset.index;
        secondIndex = firstIndex - 1;

        swapping(
            document.getElementById("expertName" + firstIndex),
            document.getElementById("expertName" + secondIndex)
        );
        swapping(
            document.getElementById("expertCompany" + firstIndex),
            document.getElementById("expertCompany" + secondIndex)
        );
    });
});

/**
 * SWAPPER signature row
 */
let up2 = document.getElementsByClassName("btn-up2");
Array.from(up2).forEach((element) => {
    element.addEventListener("click", function (e) {
        firstIndex = this.dataset.index;
        secondIndex = firstIndex - 1;

        swapping(
            document.getElementById("expertNameNip" + firstIndex),
            document.getElementById("expertNameNip" + secondIndex)
        );
        swapping(
            document.getElementById("expertCompanyRole" + firstIndex),
            document.getElementById("expertCompanyRole" + secondIndex)
        );
    });
});

function swapping(firstElement, secondElement) {
    firstInner = firstElement.innerText;
    secondInner = secondElement.innerText;

    firstElement.innerText = secondInner;
    secondElement.innerText = firstInner;
}

function swappingSrc(firstElement, secondElement) {
    firstInner = firstElement.src;
    secondInner = secondElement.src;

    firstElement.src = secondInner;
    secondElement.src = firstInner;
}
