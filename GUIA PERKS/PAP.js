function getRandomLightColor() {
    
    const r = Math.floor(Math.random() * 128 + 127); 
    const g = Math.floor(Math.random() * 128 + 127); 
    const b = Math.floor(Math.random() * 128 + 127); 
    return `rgb(${r},${g},${b})`;
}

function changeFieldsetColors() {
   
    const fieldsets = document.querySelectorAll('fieldset');
    
    fieldsets.forEach(fieldset => {
        fieldset.style.backgroundColor = getRandomLightColor();
    });
}
window.addEventListener('load', changeFieldsetColors);
