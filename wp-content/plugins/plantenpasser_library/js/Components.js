const displayBootstrapAlert = (type, text) =>{
    return `
        <div class="alert alert-${type} text-center" role="alert" id="alert-box">
            ${text}
        </div>
    `;
}