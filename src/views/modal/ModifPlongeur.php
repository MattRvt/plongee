<div class="modal" id="modifPersModal">
    <div class="modal-content">
        <form id="send" onsubmit="return verifSubmit()" method="post" >
            <div id="numIdentification"></div>

            <input type="hidden" id="numInput" name="num"/><br/>

            <label>
                Nom :
                <input type="text" class="inputBox" id="nom" name="nom" onkeyup="validation(0)" onfocusout="unfocus('nom')" autocomplete="off"/><br/>
            </label>
            <span id ="spannom" class="red-text text-darken-2"><script type="text/javascript">afficheErreur(0)</script></span>

            <label>
                Prénom :
                <input type="text" class="inputBox" id="prenom" name="prenom" onkeyup="validation(1)" onfocusout='unfocus("prenom")' autocomplete='off' /> <br/>
            </label>
            <span id = "spanprenom" class="red-text text-darken-2"><script type="text/javascript">afficheErreur(1)</script></span><br/>

            <div id="aptitudePlong"></div>

            <input type="submit" value="Modifier" name="modifier"/>
            <input type="submit" id="etat" name="etat"/>
        </form>
    </div>
</div>



