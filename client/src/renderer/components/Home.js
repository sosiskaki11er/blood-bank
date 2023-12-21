import React from 'react'
import Banner from './Banner'
import Appointments from './Appointments'
import Medinfo from './Medinfo'
import History from './History'
import Requests from './Requests'
import BloodAvailable from './BloodAvailable'
import UserTable from './UserTable'

function Home({subpage, handleSubpage,role}) {
  const user = JSON.parse(localStorage.getItem('user'))
  return (
    <div className='subpage'>
        <Banner/>
        {(role === 'staff') && <BloodAvailable role={role}/>}
        {(role !== 'admin' && role !== 'doctor' && role !== 'staff') && <Appointments handleSubpage={handleSubpage} role={role} subpage={subpage}/>}
        {(role === 'doctor') && <BloodAvailable role={role}/>}
        {(role === 'admin') && <UserTable type={"donors"}/>}
        {(role === 'admin') && <UserTable type={"patients"}/>}
        {(role === 'admin') && <UserTable type={"doctors"}/>}
        {(role === 'admin') && <UserTable type={"staff"}/>}
    </div>
  )
}

export default Home