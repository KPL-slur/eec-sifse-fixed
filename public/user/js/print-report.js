// window.print();

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

                firstSrc = document.getElementById("image_" + firstId).src;
                secondSrc = document.getElementById("image_" + secondId).src;

                firstText = document.getElementById("caption_" + firstId)
                    .innerText;
                secondText = document.getElementById("caption_" + secondId)
                    .innerText;

                document.getElementById("image_" + firstId).src = secondSrc;
                document.getElementById("image_" + secondId).src = firstSrc;

                document.getElementById(
                    "caption_" + firstId
                ).innerText = secondText;
                document.getElementById(
                    "caption_" + secondId
                ).innerText = firstText;

                click = 0;
                break;

            default:
                break;
        }
    });
});

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

function swapping(firstElement, secondElement) {
    firstInner = firstElement.innerText;
    secondInner = secondElement.innerText;

    firstElement.innerText = secondInner;
    secondElement.innerText = firstInner;
}
