(function(){
    const tagsInput = document.querySelector('#tags_input');

    
    if(tagsInput){

        const tagsDiv = document.querySelector('#tags');
        const tagsInputHidden = document.querySelector('[name=tags]');

        let tags = [];

        //Escuchar los cambios en el input
        tagsInput.addEventListener('keypress', guardarTag);

        function guardarTag(e){
            if(e.keyCode === 44){//si el codigo de la tecla es igual a 44
               if(e.target.value.trim() === '' || e.target.value < 1){
                return;
               }
               
                e.preventDefault();
                
                tags = [...tags, e.target.value.trim()];//hacemos una copia del tag y le colocamos el valor del evento sin estacios vacios
                tagsInput.value = '';//limpiaos el input

                mostrarTags();   
            }
        }

        function mostrarTags(){
            tagsDiv.textContent = '';
            tags.forEach(tag => {
                const etiqueta = document.createElement('LI');
                etiqueta.classList.add('formulario__tag');
                etiqueta.textContent = tag;
                etiqueta.ondblclick = eliminarTag;
                tagsDiv.appendChild(etiqueta);
            })

            actualizarInputHidden();
        }

        function eliminarTag(e){
            e.target.remove();
            tags = tags.filter(tag => tag !== e.target.textContent);

            actualizarInputHidden();   
        }

        function actualizarInputHidden(){
            tagsInputHidden.value = tags.toString();
        }
    }
})()