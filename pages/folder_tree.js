document.addEventListener('DOMContentLoaded', () => {
    const folderSelect = document.getElementById('folderSelect');

    // Получаем список папок с сервера
    fetch('folder_list.php')
        .then(response => response.json())
        .then(data => {
            // Создаем дерево папок
            const tree = createFolderTree(data);
            folderSelect.innerHTML = tree;
        })
        .catch(error => {
            console.error('Ошибка при получении списка папок:', error);
        });
});

function createFolderTree(folders) {
    let tree = '<ul>';
    folders.forEach(folder => {
        tree += `<li><input type="radio" name="folder" value="${folder}">${folder}</li>`;
    });
    tree += '</ul>';
    return tree;
}