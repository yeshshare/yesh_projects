/*
Comandos
Grouponlineusers

*/
function Grouponlineusers(room, onlineUsers, wss) {

    var userlist = {
        command: 'group-online-users',
    };
    var users = [];
    wss.clients.forEach(client => {
        if (client.room[0] == room) {
            let listUsers = onlineUsers.filter(u => u.id == client.user_id)
            listUsers.forEach(user => {
                if (!users.some(u => u.id == user.id)) {
                    users.push(user);
                }
            });
        }
    })
    userlist.data = users;
    return userlist;
}
export default Grouponlineusers;            