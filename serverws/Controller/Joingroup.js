function Joingroup(messag, ws, onlineUsers) {
    ws.room.push(messag.data.room);
    ws.user_id.push(messag.data.user.id);
    onlineUsers.push(messag.data.user);
    ws.projetc_id.push(messag.data.projetc_id);
    ws.company_id.push(messag.data.company_id);

};
export default Joingroup;