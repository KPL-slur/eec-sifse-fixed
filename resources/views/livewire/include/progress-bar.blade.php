<template x-if="type == 'cm'">
    <div class="card my-0">
        <div class="card-body">
            <div class="progress-container">
                <span class="progress-badge"></span>
                <div class="progress mb-0">
                    <div class="progress-bar" role="progressbar" style="width: 25%;" x-show="step === 1"></div>
                    <div class="progress-bar" role="progressbar" style="width: 50%;" x-show="step === 2"></div>
                    <div class="progress-bar" role="progressbar" style="width: 75%;" x-show="step === 3"></div>
                    <div class="progress-bar" role="progressbar" style="width: 100%;" x-show="step === 4"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<template x-if="type == 'pm'">
    <div class="card my-0">
        <div class="card-body">
            <div class="progress-container">
                <span class="progress-badge"></span>
                <div class="progress mb-0">
                    <div class="progress-bar" role="progressbar" style="width: 20%;" x-show="step === 1"></div>
                    <div class="progress-bar" role="progressbar" style="width: 40%;" x-show="step === 2"></div>
                    <div class="progress-bar" role="progressbar" style="width: 60%;" x-show="step === 3"></div>
                    <div class="progress-bar" role="progressbar" style="width: 80%;" x-show="step === 4"></div>
                    <div class="progress-bar" role="progressbar" style="width: 100%;" x-show="step === 5"></div>
                </div>
            </div>
        </div>
    </div>
</template>