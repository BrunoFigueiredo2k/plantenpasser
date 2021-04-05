const displayBootstrapAlert = (type, text) =>{
    return `
        <div class="alert alert-${type} text-center" role="alert" id="alert-box">
            ${text}
        </div>
    `;
}

const displayLoadingIcon = () => {
    return `
        <style>
            .loader {
                animation: spin 2s linear infinite;
                display: inline-block;
                margin: 0 auto;
                width: 100%;
                margin: 20px 0 15px 0;
            }

            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
        </style>

        <div class="text-center">
            <div class="loader"></div>
            <b>Bezig met toevoegen aan winkelmandje...</b>
        </div>
    `;
}