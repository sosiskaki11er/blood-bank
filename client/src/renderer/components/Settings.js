import React from 'react'
import PersonalInfo from './PersonalInfo'
import MedicalInfo from './MedicalInfo'
import ChangePassword from './ChangePassword'

function Settings() {
  return (
    <div className='subpage'>
      <PersonalInfo/>
      <MedicalInfo/>
      <ChangePassword/>
    </div>
  )
}

export default Settings