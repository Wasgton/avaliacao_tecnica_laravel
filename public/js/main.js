function addPhoneLine(element){

    $inputsQnt = $("input[name^='phone']").length;
    $inputsQnt = $inputsQnt+1;

    $(element).before(`
        <div class="form-group">
            <label for="">Telefone adicional</label>
            <input type="text" name="phone[${$inputsQnt}]" id="phone[1]" class="form-control">
        </div>
    `);

}
