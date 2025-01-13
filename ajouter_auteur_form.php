<!-- Formulaire d'ajout d'un auteur et renvoie vers ajouter_auteur_function -->
<form action="ajouter_auteur_function.php" method="post">
        <div class="mb-3">
          <label for="Nom" class="form-label">Nom:</label>
          <input type="text" name="Nom" class="form-control" id="Nom" required>
        </div>
        <div class="mb-3">
          <label for="Penom" class="form-label">Prenom:</label>
          <input type="text" name="Prenom" class="form-control" id="Prenom" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter auteur</button>
      </form>