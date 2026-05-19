<?php
require_once 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Login System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-100">
    <!-- Header -->
    <header class="bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <div class="flex items-center">
                <h1 class="text-2xl font-bold">LoginSystem</h1>
            </div>
            <div class="flex items-center space-x-6">
                <span class="text-lg">Welcome, <span class="font-semibold"><?php echo htmlspecialchars($username); ?></span>!</span>
                <button onclick="openUserModal()" class="bg-white text-blue-500 hover:bg-blue-50 font-bold py-2 px-4 rounded-lg transition duration-200">
                    Users
                </button>
                <button onclick="openAddUserModal()" class="bg-white text-green-600 hover:bg-green-50 border border-green-500 font-bold py-2 px-4 rounded-lg transition duration-200">
                    Add User
                </button>
                <button onclick="confirmLogout()" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                    Logout
                </button>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="flex-grow max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Welcome to Your Dashboard</h2>
            <p class="text-gray-600 text-lg mb-6">
                Hello, <span class="font-semibold text-blue-600"><?php echo htmlspecialchars($username); ?></span>! 
                You have successfully logged in to your account.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <div class="bg-blue-50 p-6 rounded-lg border-l-4 border-blue-500">
                    <h3 class="text-xl font-bold text-blue-700 mb-2">Account</h3>
                    <p class="text-gray-600">Manage your account details and preferences.</p>
                </div>
                <div class="bg-purple-50 p-6 rounded-lg border-l-4 border-purple-500">
                    <h3 class="text-xl font-bold text-purple-700 mb-2">Users</h3>
                    <p class="text-gray-600">View and manage all registered users. Click the Users button above.</p>
                </div>
                <div class="bg-green-50 p-6 rounded-lg border-l-4 border-green-500">
                    <h3 class="text-xl font-bold text-green-700 mb-2">Security</h3>
                    <p class="text-gray-600">Your password is securely encrypted and protected.</p>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-6 mt-auto">
        <p>&copy; 2026 Login System. All rights reserved.</p>
    </footer>

    <!-- User Management Modal -->
    <div id="userModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] overflow-auto m-4">
            <div class="sticky top-0 bg-gradient-to-r from-blue-500 to-purple-600 text-white p-6 flex justify-between items-center">
                <h2 class="text-2xl font-bold">Registered Users</h2>
                <button onclick="closeUserModal()" class="text-2xl hover:text-gray-200">&times;</button>
            </div>

            <div class="p-6">
                <div id="usersContainer" class="space-y-4">
                    <p class="text-gray-500 text-center">Loading users...</p>
                </div>
            </div>

            <div class="sticky bottom-0 bg-gray-100 p-6 flex justify-end border-t">
                <button onclick="closeUserModal()" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded-lg transition duration-200">
                    Close
                </button>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div id="editUserModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white p-6 flex justify-between items-center">
                <h2 class="text-2xl font-bold">Edit User</h2>
                <button onclick="closeEditModal()" class="text-2xl hover:text-gray-200">&times;</button>
            </div>

            <form id="editUserForm" class="p-6 space-y-4">
                <input type="hidden" id="editUserId" name="user_id">
                
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Username</label>
                    <input type="text" id="editUsername" name="username" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input type="email" id="editEmail" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">New Password (leave blank to keep current)</label>
                    <input type="password" id="editPassword" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="New password">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Confirm New Password</label>
                    <input type="password" id="editConfirmPassword" name="confirm_password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Confirm new password">
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                        Save Changes
                    </button>
                    <button type="button" onclick="closeEditModal()" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add User Modal -->
    <div id="addUserModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
            <div class="bg-gradient-to-r from-green-500 to-lime-600 text-white p-6 flex justify-between items-center">
                <h2 class="text-2xl font-bold">Add New User</h2>
                <button onclick="closeAddUserModal()" class="text-2xl hover:text-gray-200">&times;</button>
            </div>

            <form id="addUserForm" class="p-6 space-y-4">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Username</label>
                    <input type="text" id="addUsername" name="username" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input type="email" id="addEmail" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Password</label>
                    <input type="password" id="addPassword" name="password" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Confirm Password</label>
                    <input type="password" id="addConfirmPassword" name="confirm_password" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit" class="flex-1 bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                        Create User
                    </button>
                    <button type="button" onclick="closeAddUserModal()" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openUserModal() {
            document.getElementById('userModal').classList.remove('hidden');
            loadUsers();
        }

        function closeUserModal() {
            document.getElementById('userModal').classList.add('hidden');
        }

        function closeEditModal() {
            document.getElementById('editUserModal').classList.add('hidden');
        }

        function openAddUserModal() {
            document.getElementById('addUserModal').classList.remove('hidden');
        }

        function closeAddUserModal() {
            document.getElementById('addUserModal').classList.add('hidden');
        }

        function confirmLogout() {
            if (confirm('Are you sure you want to logout?')) {
                window.location.href = 'logout.php';
            }
        }

        function loadUsers() {
            const container = document.getElementById('usersContainer');
            container.innerHTML = '<p class="text-gray-500 text-center">Loading users...</p>';

            fetch('api/get_users.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.users && data.users.length > 0) {
                        container.innerHTML = '';
                        data.users.forEach(user => {
                            const userCard = document.createElement('div');
                            userCard.className = 'bg-gray-50 p-4 rounded-lg border border-gray-200 flex justify-between items-center';

                            const info = document.createElement('div');
                            const name = document.createElement('h3');
                            name.className = 'font-bold text-gray-800';
                            name.textContent = user.username;
                            const email = document.createElement('p');
                            email.className = 'text-gray-600 text-sm';
                            email.textContent = user.email;
                            const joined = document.createElement('p');
                            joined.className = 'text-gray-500 text-xs mt-1';
                            joined.textContent = 'Joined: ' + new Date(user.created_at).toLocaleDateString();

                            info.appendChild(name);
                            info.appendChild(email);
                            info.appendChild(joined);

                            const actions = document.createElement('div');
                            actions.className = 'flex gap-2';

                            const editButton = document.createElement('button');
                            editButton.className = 'bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition duration-200';
                            editButton.textContent = 'Edit';
                            editButton.addEventListener('click', () => editUser(user.id, user.username, user.email));

                            const deleteButton = document.createElement('button');
                            deleteButton.className = 'bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg transition duration-200';
                            deleteButton.textContent = 'Delete';
                            deleteButton.addEventListener('click', () => deleteUserConfirm(user.id, user.username));

                            actions.appendChild(editButton);
                            actions.appendChild(deleteButton);

                            userCard.appendChild(info);
                            userCard.appendChild(actions);
                            container.appendChild(userCard);
                        });
                    } else {
                        container.innerHTML = '<p class="text-gray-500 text-center">No users found.</p>';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    container.innerHTML = '<p class="text-red-500 text-center">Error loading users.</p>';
                });
        }

        function editUser(userId, username, email) {
            document.getElementById('editUserId').value = userId;
            document.getElementById('editUsername').value = username;
            document.getElementById('editEmail').value = email;
            document.getElementById('editPassword').value = '';
            document.getElementById('editConfirmPassword').value = '';
            document.getElementById('editUserModal').classList.remove('hidden');
        }

        function deleteUserConfirm(userId, username) {
            if (confirm(`Are you sure you want to delete user "${username}"? This action cannot be undone.`)) {
                if (confirm('Please confirm again to permanently delete this user.')) {
                    deleteUser(userId);
                }
            }
        }

        function deleteUser(userId) {
            fetch('api/delete_user.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'user_id=' + userId
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('User deleted successfully!');
                    loadUsers();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error deleting user.');
            });
        }

        document.getElementById('editUserForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const userId = document.getElementById('editUserId').value;
            const username = document.getElementById('editUsername').value;
            const email = document.getElementById('editEmail').value;
            const password = document.getElementById('editPassword').value;
            const confirmPassword = document.getElementById('editConfirmPassword').value;

            if (password !== '' && password !== confirmPassword) {
                alert('Passwords do not match.');
                return;
            }

            if (!confirm('Are you sure you want to save changes to this user?')) {
                return;
            }

            const body = 'user_id=' + userId + '&username=' + encodeURIComponent(username) + '&email=' + encodeURIComponent(email) + (password ? '&password=' + encodeURIComponent(password) : '');

            fetch('api/edit_user.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: body
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('User updated successfully!');
                    closeEditModal();
                    loadUsers();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error updating user.');
            });
        });

        document.getElementById('addUserForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const username = document.getElementById('addUsername').value.trim();
            const email = document.getElementById('addEmail').value.trim();
            const password = document.getElementById('addPassword').value;
            const confirmPassword = document.getElementById('addConfirmPassword').value;

            if (!username || !email || !password) {
                alert('All fields are required.');
                return;
            }

            if (password !== confirmPassword) {
                alert('Passwords do not match.');
                return;
            }

            if (!confirm('Are you sure you want to create this user?')) return;

            const body = 'username=' + encodeURIComponent(username) + '&email=' + encodeURIComponent(email) + '&password=' + encodeURIComponent(password);

            fetch('api/add_user.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: body
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert('User created successfully!');
                    document.getElementById('addUserForm').reset();
                    closeAddUserModal();
                    loadUsers();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(err => {
                console.error(err);
                alert('Error creating user.');
            });
        });

        function escapeHtml(text) {
            const map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };
            return text.replace(/[&<>"']/g, m => map[m]);
        }

        // Close modal when clicking outside
        document.getElementById('userModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeUserModal();
            }
        });

        document.getElementById('editUserModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });

        document.getElementById('addUserModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeAddUserModal();
            }
        });
    </script>
</body>
</html>
