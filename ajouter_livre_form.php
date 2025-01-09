<!-- Formulaire d'ajout d'un livre et renvoie vers ajouter_livre_function -->
<form action="ajouter_livre_function.php" method="post">
        <div class="mb-3">
          <label for="noauteur" class="form-label">Auteur:</label>
          <select name="noauteur" class="form-control" id="noauteur" required>
            <?php foreach ($auteurs as $auteur): ?>
              <option value="<?= $auteur->noauteur ?>"><?= $auteur->prenom . ' ' . $auteur->nom ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="mb-3">
          <label for="titre" class="form-label">Titre:</label>
          <input type="text" name="titre" class="form-control" id="titre" required>
        </div>
        <div class="mb-3">
          <label for="isbn13" class="form-label">ISBN13:</label>
          <input type="text" name="isbn13" class="form-control" id="isbn13" required>
        </div>
        <div class="mb-3">
          <label for="anneeparution" class="form-label">Année de parution:</label>
          <input type="text" name="anneeparution" class="form-control" id="anneeparution" required>
        </div>
        <div class="mb-3">
          <label for="detail" class="form-label">Résumé:</label>
          <textarea name="detail" class="form-control" id="detail" rows="3" required></textarea>
        </div>
        <div class="mb-3">
          <label for="photo" class="form-label">Image:</label>
          <input type="text" name="photo" class="form-control" id="photo" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
      </form>