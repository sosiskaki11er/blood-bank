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
        {(role === 'H. Staff' || role === 'Admin') && <BloodAvailable/>}
        {(role !== 'Admin') && <Appointments handleSubpage={handleSubpage} role={role} subpage={subpage}/>}
        {(role === 'Patient') && <Medinfo handleSubpage={handleSubpage}/>}
        {(role === 'Doctor' || role==='H. Staff') && <Requests handleSubpage={handleSubpage}/>}
        {(role === 'Doctor') && <BloodAvailable/>}
        {(role === 'Patient' || role === 'Donor') && <History/>}
        {(role === 'Admin')&& <UserTable/>}
        {(role === 'Admin')&& <UserTable/>}
        {(role === 'Admin')&& <UserTable/>}
        {(role === 'Admin')&& <UserTable/>}
    </div>
  )
}

export default Home