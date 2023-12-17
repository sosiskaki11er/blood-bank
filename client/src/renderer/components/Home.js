import React from 'react'
import Banner from './Banner'
import Appointments from './Appointments'
import Medinfo from './Medinfo'
import History from './History'
import Requests from './Requests'
import BloodAvailable from './BloodAvailable'
import UserTable from './UserTable'

function Home({subpage, handleSubpage,role}) {
  return (
    <div className='subpage'>
        <Banner/>
        {(role === 'staff' || role === 'admin') && <BloodAvailable/>}
        {(role !== 'admin') && <Appointments handleSubpage={handleSubpage} role={role} subpage={subpage}/>}
        {(role === 'patient') && <Medinfo handleSubpage={handleSubpage}/>}
        {(role === 'doctor' || role==='staff') && <Requests handleSubpage={handleSubpage}/>}
        {(role === 'doctor') && <BloodAvailable/>}
        {(role === 'patient' || role === 'donor') && <History/>}
        {(role === 'admin')&& <UserTable/>}
        {(role === 'admin')&& <UserTable/>}
        {(role === 'admin')&& <UserTable/>}
        {(role === 'admin')&& <UserTable/>}
    </div>
  )
}

export default Home